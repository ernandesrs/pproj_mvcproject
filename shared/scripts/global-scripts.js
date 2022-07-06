let timeoutHandler = null;

$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

/**
 * ALERTA/MENSAGENS
 */
$(function () {
    let messageAreas = $(".message-area");

    $.each(messageAreas, function (k, v) {
        let alert = $(v).find(".alert");

        if (alert.length) {
            showAlert(alert);
        }
    });
});

/**
 * SUBMISSÃO DE FORMULÁRIOS
 */
$(function () {

    $("form").on("submit", function (e) {
        e.preventDefault();
        let form = $(this);
        let submitButton = $(e.originalEvent.submitter);
        let action = form.attr("action");
        let data = (new FormData(form[0]));
        let localMessageArea = form.find(".message-area");

        $.ajax({
            url: action,
            data: data,
            method: 'POST',
            processData: false,
            contentType: false,
            dataType: 'json',

            beforeSend: function () {
                addLoadingMode(submitButton);
            },

            success: function (response) {
                if (response.redirect) {
                    window.location.href = response.redirect;
                    return;
                }

                if (response.reload) {
                    window.location.reload();
                    return;
                }

                if (response.message) {
                    addAlert($(response.message), localMessageArea.length ? localMessageArea : $("body").find(".message-area"));
                }

                addFormErrors(form, response.errors ?? null);
            },

            complete: function () {
                removeLoadingMode(submitButton);
            }
        });
    });

});

/**
 * 
 * CLICKS EM BOTÕES COM CONFIRMAÇÃO DE AÇÃO
 * 
 */
$(function () {
    let confirmationModal = $(".jsConfirmationModal");

    $(".jsConfirmationModalButton").on("click", function (e) {
        e.preventDefault();
        let action = $(this).attr("data-action");
        let style = $(this).attr("data-style");
        let message = $(this).attr("data-message");

        confirmationModal.addClass("modal-" + (style ?? "default"))
            .find("form").attr("action", action)
            .find(".message").html(message)
            .parent().find("button[type=submit]").addClass("btn-" + style);

        confirmationModal.modal();

    });

    confirmationModal.on("hidden.bs.modal", function () {
        confirmationModal.removeClass("modal-default modal-success modal-danger modal-info modal-warning")
            .find("form").attr("action", "")
            .find(".message").html("")
            .parent().find("button[type=submit]").removeClass("btn-default btn-success btn-danger btn-info btn-warning");
    });

});

/**
 * 
 * FUNÇÕES: BACKDROP
 * 
 */

/**
 * @param {String} id id para o backdrop
 * @param {String} position tipo de posicionamento. Padrão é 'absolute'
 * @param {String} container onde inserir o backdrop. Padrão é o 'body'
 * @param {String} effect efeito do jquery-ui. Padrão é 'fade'
 */
function addBackdrop(id, position, container, effect) {
    let cntnr = $(container ?? "body");
    let efct = effect ?? "fade";
    let bkdrop = $(`<div id="${id}"></div>`).css({
        "background-color": "rgb(0, 0, 0, 0.5)",
        width: "100%",
        height: "100%",
        position: position ?? "absolute",
        top: 0,
        left: 0,
        "z-index": 998,
    }).hide();

    cntnr.append(bkdrop.show(efct));
}

/**
 * @param {String} id id do backdrop a ser removido
 * @param {String} container local onde procurar o backdrop. Por padrão busca por todo o 'body'
 * @param {String} effect efeito do jquery-ui. Padrão é 'fade'
 */
function removeBackdrop(id, container, effect) {
    let cntnr = $(container ?? "body");
    let efct = effect ?? "fade";

    cntnr.find("#" + id).hide(efct, function () {
        $(this).remove();
    });
}

/**
 * 
 * FUNÇÕES: BOTÕES
 * 
 */

/**
 * @param {jQuery} buttonObject objeto jQuery do botão
 */
function addLoadingMode(buttonObject) {
    buttonObject
        .removeClass(buttonObject.attr("data-active-icon"))
        .addClass(buttonObject.attr("data-alt-icon"))
        .prop("disabled", true);
}

/**
 * @param {jQuery} buttonObject objeto jQuery do botão
 */
function removeLoadingMode(buttonObject) {
    buttonObject
        .addClass(buttonObject.attr("data-active-icon"))
        .removeClass(buttonObject.attr("data-alt-icon"))
        .prop("disabled", false);
}

/**
 * 
 * FUNÇÕES: FORM ERRORS
 * 
 */

/**
 * @param {jQuery} formObject
 * @param {Array} errs
 */
function addFormErrors(formObject, errs) {
    let fields = formObject.find("input, select, textarea");
    let errors = errs ?? [];

    if (!fields.length) return;

    $.each(fields, function (fieldKey, field) {
        let fieldObj = $(field);
        let fieldName = fieldObj.attr("name");

        if (errors[fieldName]) {
            let invalid = fieldObj.parent().find(".invalid-feedback");

            if (invalid.length) invalid.html(errors[fieldName]);
            else fieldObj.parent().append(`<div class="invalid-feedback">${errors[fieldName]}</div>`);

            fieldObj.addClass("is-invalid");
        } else {
            fieldObj
                .removeClass("is-invalid")
                .parent().find(".invalid-feedback").hide("fade", function () {
                    $(this).remove();
                });
        }
    });
}

/**
 * 
 * FUNÇÕES: ALERTS/MESSAGES
 * 
 */

/**
 * @param {jQuery} alert objeto jquery do elemento de mensagem
 * @param {jQuery|null} container objeto jquery do container de mensagem. Padrão será o primeiro .message-area encontrado
 */
function addAlert(alert, container = null) {
    let cntnr = container ?? $(".message-area");
    cntnr.html(alert);
    showAlert(alert);
}

/**
 * @param {jQuery} alert 
 */
function showAlert(alert) {
    console.log(alert);
    if (alert.hasClass("alert-float")) {
        alert.show("blind", function () {
            $(this).effect("bounce");
        });
    } else {
        alert.show("fade");
    }

    if (timer = alert.attr("data-timer")) {
        if (timeoutHandler)
            clearTimeout(timeoutHandler);
        runTimer(alert);
    }
}

/**
 * @param {jQuery} alert 
 */
function removeAlert(alert) {
    if (alert.hasClass("alert-float")) {
        alert.effect("bounce", function () {
            $(this).hide("blind", function () {
                $(this).remove();
            });
        });
    } else {
        alert.hide("fade", function () {
            $(this).remove();
        });
    }
}

/**
 * @param {jQuery} alert 
 */
function runTimer(alert) {
    timeoutHandler = setTimeout(function () {
        removeAlert(alert);
    }, timer * 1000);
}