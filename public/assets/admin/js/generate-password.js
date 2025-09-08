function generateRandomString(length = 15) {
    let characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@$%&()_+-?';
    let result = '';
    for (let i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() * characters.length));
    }
    return result;
}

$(document).ready(function () {
    $('#copyButton').hide();
    
    $('#generatePassword').on('click', function () {
        $('#copyButton').show();
        let password = generateRandomString(15);
        $('#password').val(password);
        $('#password_confirmation').val(password);
    });
    $('#password').on('input', function() {
        if ($(this).val().length > 0) {
            $('#copyButton').show();
        } else {
            $('#copyButton').hide();
        }
    });
});
$(document).on('click', '#copyButton', function () {
    var copyInput = $('#password');

    // Temporarily change type to text
    copyInput.attr('type', 'text');

    // Select and copy
    copyInput[0].select();
    document.execCommand('copy');
    $('#copyMessage').removeClass('d-none');

    // Change back to password
    copyInput.attr('type', 'password');

    setTimeout(function () {
        $('#copyMessage').addClass('d-none');
    }, 2000);
});