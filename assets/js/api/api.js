(function ($) {
  console.log("Hola JQuery Create Car");
  var exito = true;
  var carId = "";
  var personId = "";
  var retomaId = "";
  $("[name='cf7mls_next']").text("Siguiente");
  $("[name='cf7mls_back']").text("Anterior");
  $("[name='cf7mls_back']").val("Anterior");
  $(
    document.addEventListener("wpcf7submit", function (event) {
      if (event.detail.contactFormId == "7701") {
        // =========================
        // CREAR PERSONA
        $.ajax({
          url: automagno.ajaxurl,
          method: "POST",
          data: {
            action: "crearPersonaASC",
            data: event.detail.inputs,
          },
          // =========================
          // CREAR RETOMA
          success: function (data) {
            $("#your-id-person").val(data);
            personId = $("#your-id-person").val();
            $.ajax({
              url: automagno.ajaxurl,
              method: "POST",
              data: {
                action: "crearRetomaASC",
                data: event.detail.inputs,
                id: personId,
              },
              // =========================
              // CREAR CARRO
              success: function (data) {
                retomaId = $("#your-id-person").val();
                $("#your-id-person").val(data);
                $.ajax({
                  url: automagno.ajaxurl,
                  method: "POST",
                  data: {
                    action: "crearCarASC",
                    data: event.detail.inputs,
                    id: retomaId,
                  },
                  // =========================
                  success: function (data) {
                    console.log(data);
                    $("#your-id-person").val(data);
                    carId = $("#your-id-person").val();
                    var info = new FormData();
                    info.append("action", "variablesS3ASC");
                    info.append(
                      "file",
                      $("#vehicule-picture").prop("files")[0]
                    );
                    $.ajax({
                      url: automagno.ajaxurl,
                      method: "post",
                      processData: false,
                      contentType: false,
                      data: info,
                      success: function (response) {
                        var uploadFiles = $("#vehicule-picture")[0];
                        var upFile = uploadFiles.files[0];
                        var albumBucketName = response[0]["bucket"];
                        var bucketRegion = response[0]["region"];
                        var IdentityPoolId = response[0]["identityPoolId"];
                        AWS.config.update({
                          region: bucketRegion,
                          credentials: new AWS.CognitoIdentityCredentials({
                            IdentityPoolId: IdentityPoolId,
                          }),
                        });
                        var upload = new AWS.S3.ManagedUpload({
                          params: {
                            Bucket: albumBucketName,
                            Key:
                              response[0]["key"] +
                              "." +
                              upFile.name.split(".").pop(),
                            Body: upFile,
                            ACL: response[0]["acl"],
                          },
                          tags: [
                            { Key: "retomaId", Value: retomaId },
                            { Key: "carId", Value: carId },
                          ],
                        });
                        var promise = upload.promise();
                        promise.then(
                          function (data) {
                            alert("¡Registro exitoso!");
                            location.reload();
                          },
                          function (err) {
                            alert("Ha ocurrido un error");
                            console.log(
                              "There was an error uploading your photo: ",
                              err.message
                            );
                          }
                        );
                      },
                    });
                  },
                });
              },
              error: function (error) {
                console.log(error);
              },
            });
          },
          error: function (error) {
            console.log(error);
          },
        });
      }
    })
  );

  $(document).ready(function () {
    $(".wpcf7-form .wpcf7-pipes .wpcf7-select option").each(function (
      index,
      element
    ) {
      var data = element.text.split(";");

      $(this).val(data[1]);
      $(this).text(data[0]);
    });

    $("#vehicule-modelo").prop("disabled", true);
    $("#vehicule-marca").prop("disabled", true);
    $("#vehicule-linea").prop("disabled", true);
    $("#vehicule-version").prop("disabled", true);
    $.ajax({
      url: automagno.ajaxurl,
      method: "POST",
      data: {
        action: "listarCategoriasASC",
      },
      success: function (data) {
        $("#vehicule-categoria").find("option").remove().end();
        for (var element in data) {
          $("#vehicule-categoria").prepend(
            "<option value='" + element + "' >" + data[element] + "</option>"
          );
        }
        $("#vehicule-categoria").prepend(
          "<option value selected>-- Categoria --</option>"
        );
      },
      error: function (error) {
        console.log(error);
      },
    });

    $.ajax({
      url: automagno.ajaxurl,
      method: "POST",
      data: {
        action: "listarCiudadesASC",
        value: "58cfb609-23ce-41af-a91b-36ed7d13d54d",
      },
      success: function (data) {
        $("#vehicule-lugar_placa").find("option").remove().end();
        for (var element in data) {
          $("#vehicule-lugar_placa").prepend(
            "<option value='" + element + "' >" + data[element] + "</option>"
          );
        }
        $("#vehicule-lugar_placa").prepend(
          "<option value selected>-- Ciudad --</option>"
        );
      },
      error: function (error) {
        console.log(error);
      },
    });

    $("#vehicule-categoria").change(function () {
      $.ajax({
        url: automagno.ajaxurl,
        method: "POST",
        data: {
          action: "listarEstadosASC",
          value: $("#vehicule-categoria option:selected").val(),
        },
        success: function (data) {
          $.ajax({
            url: automagno.ajaxurl,
            method: "POST",
            data: {
              action: "listarModelosASC",
              value: data,
            },
            success: function (data) {
              $("#vehicule-modelo").prop("disabled", false);
              $("#vehicule-modelo").find("option").remove().end();
              for (var element in data) {
                $("#vehicule-modelo").prepend(
                  "<option value='" +
                    element +
                    "' >" +
                    data[element] +
                    "</option>"
                );
              }
              $("#vehicule-modelo").prepend(
                "<option value selected>-- Modelo --</option>"
              );
              $("#vehicule-marca").prop("disabled", true);
              $("#vehicule-linea").prop("disabled", true);
              $("#vehicule-version").prop("disabled", true);
              $("#vehicule-marca").find("option").remove().end();
              $("#vehicule-marca").prepend(
                "<option value selected>-- Marca --</option>"
              );
              $("#vehicule-linea").find("option").remove().end();
              $("#vehicule-linea").prepend(
                "<option value selected>-- Linea --</option>"
              );
              $("#vehicule-version").find("option").remove().end();
              $("#vehicule-version").prepend(
                "<option value selected>-- Versión --</option>"
              );
            },
            error: function (error) {
              console.log(error);
            },
          });
        },
        error: function (error) {
          console.log(error);
        },
      });
    });

    $("#vehicule-modelo").change(function () {
      $.ajax({
        url: automagno.ajaxurl,
        method: "POST",
        data: {
          action: "listarMarcasASC",
          value: $("#vehicule-modelo option:selected").val(),
        },
        success: function (data) {
          $("#vehicule-marca").prop("disabled", false);
          $("#vehicule-marca").find("option").remove().end();
          for (var element in data) {
            $("#vehicule-marca").prepend(
              "<option value='" + element + "' >" + data[element] + "</option>"
            );
          }
          $("#vehicule-marca").prepend(
            "<option value selected>-- Marca --</option>"
          );
          $("#vehicule-linea").prop("disabled", true);
          $("#vehicule-version").prop("disabled", true);
          $("#vehicule-linea").find("option").remove().end();
          $("#vehicule-linea").prepend(
            "<option value selected>-- Linea --</option>"
          );
          $("#vehicule-version").find("option").remove().end();
          $("#vehicule-version").prepend(
            "<option value selected>-- Versión --</option>"
          );
        },
        error: function (error) {
          console.log(error);
        },
      });
    });

    $("#vehicule-marca").change(function () {
      $.ajax({
        url: automagno.ajaxurl,
        method: "POST",
        data: {
          action: "listarLineasASC",
          value: $("#vehicule-marca option:selected").val(),
        },
        success: function (data) {
          $("#vehicule-linea").prop("disabled", false);
          $("#vehicule-linea").find("option").remove().end();
          for (var element in data) {
            $("#vehicule-linea").prepend(
              "<option value='" + element + "' >" + data[element] + "</option>"
            );
          }
          $("#vehicule-linea").prepend(
            "<option value selected>-- Linea --</option>"
          );
          $("#vehicule-version").prop("disabled", true);
          $("#vehicule-version").find("option").remove().end();
          $("#vehicule-version").prepend(
            "<option value selected>-- Versión --</option>"
          );
        },
        error: function (error) {
          console.log(error);
        },
      });
    });

    $("#vehicule-linea").change(function () {
      $.ajax({
        url: automagno.ajaxurl,
        method: "POST",
        data: {
          action: "listarVersionesASC",
          value: $("#vehicule-linea option:selected").val(),
        },
        success: function (data) {
          $("#vehicule-version").prop("disabled", false);
          $("#vehicule-version").find("option").remove().end();
          for (var element in data) {
            $("#vehicule-version").prepend(
              "<option value='" + element + "' >" + data[element] + "</option>"
            );
          }
          $("#vehicule-version").prepend(
            "<option value selected>-- Versión --</option>"
          );
        },
        error: function (error) {
          console.log(error);
        },
      });
    });

    $("#vehicule-placa").change(function () {
      var strPlaca = $("#vehicule-placa").val();
      if (strPlaca.length == 7 || strPlaca.length == 6) {
        var arreglo = strPlaca.split("-");
        if ($.isNumeric(arreglo[1])) {
          exito = true;
          var upper = strPlaca.toUpperCase();
          $("#vehicule-placa").val(upper);
          $(".form-control-label-placa").css("visibility", "hidden");
        } else {
          $(".form-control-label-placa").css("visibility", "visible");
          exito = false;
        }
      } else {
        $(".form-control-label-placa").css("visibility", "visible");
        exito = false;
      }
    });

    $("[name='cf7mls_next']").click(function (event) {
      if (exito == false) {
        event.stopPropagation();
      }
    });
  });
})(jQuery);
