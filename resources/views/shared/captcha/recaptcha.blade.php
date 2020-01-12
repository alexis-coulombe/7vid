@if(env('GOOGLE_RECAPTCHA_KEY'))
    <input type="hidden" name="recaptcha" id="recaptcha">
    <script src="https://www.google.com/recaptcha/api.js?render={{ env('GOOGLE_RECAPTCHA_KEY') }}"></script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('{{ env('GOOGLE_RECAPTCHA_KEY') }}').then(function(token) {
                if(token) {
                    document.getElementById('recaptcha').value = token;
                }
            });
        });
    </script>
@endif
