function formatError(message, errors = null) {
    var html = message;

    if (errors != null) {
        html += '<ul>';
        for (var field in errors) {
            html += '<li>' + errors[field] + '</li>';
        }
        html += '</ul>';
    }

    return html;
}

function setError(message, errors = null) {
    $('.contact-status').addClass('alert-danger').html(formatError(message, errors)).removeClass('hidden');
}

function setSuccess(message) {
    $('.contact-status').removeClass('alert-danger').addClass('alert-success').html(message).removeClass('hidden');
}

$(function() {
    $('.contact-form').on('submit', function(e) {
        e.preventDefault(); // prevent normal form submission behavior

        var form = $(this);

        // disable form while sending
        form.find('input, textarea').attr('readonly', 'readonly');
        var btnHtml = form.find('button[type="submit"]').html();
        form.find('button[type="submit"]').attr('disabled', 'disabled').html('Sending...');

        $.post(form.attr('action'), form.serialize(), function(jqxhr) {
            // leave form disabled
            form.find('button[type="submit"]').html('Sent!');

            // contact form was successfully processed
            setSuccess('Your message has been sent!');
        }, 'json')
        .fail(function(jqxhr) {
            // error handling, re-enable form
            form.find('input, textarea').removeAttr('readonly');
            form.find('button[type="submit"]').removeAttr('disabled').html(btnHtml);

            if (jqxhr.status == 422 && jqxhr.responseJSON.errors != null) {
                setError('What you entered doesn\'t look quite right.', jqxhr.responseJSON.errors);
                return;
            }

            setError('Something went wrong. (It used to work, I swear!)');
            return;
        });
    });
});
