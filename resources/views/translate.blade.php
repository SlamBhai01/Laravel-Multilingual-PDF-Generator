<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Runtime Google Translator</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-900 min-h-screen flex items-center justify-center p-6 text-gray-100">
    <div class="bg-gray-800 p-6 rounded-lg w-full max-w-xl shadow-xl">
        <h1 class="text-xl font-bold mb-4">Runtime Language Translator</h1>
        <textarea id="text" class="w-full p-3 bg-gray-700 rounded" rows="4" placeholder="Enter text to translate..."></textarea>
        <select id="lang" class="w-full p-3 bg-gray-700 rounded mt-3">
            <option value="en">English</option>
            <option value="ur">Urdu</option>
            <option value="ar">Arabic</option>
            <option value="fr">French</option>
            <option value="es">Spanish</option>
            <option value="tr">Turkish</option>
            <option value="de">German</option>
            <option value="hi">Hindi</option>
            <option value="zh-CN">Chinese</option>
        </select>
        <button id="btnTranslate" class="mt-4 bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded text-white w-full">
            Translate Now
        </button>
        <h3 class="text-md font-semibold mt-4">Translation Result:</h3>
        <div id="result" class="bg-gray-700 p-3 mt-2 rounded min-h-[60px]"></div>

    </div>

    <script>
        $('#btnTranslate').click(function() {

            var text = $('#text').val();
            var lang = $('#lang').val();

            if (text.trim() === "") {
                $('#result').html("<span class='text-red-400'>Please enter text first!</span>");
                return;
            }

            $.ajax({
                url: "/translate",
                method: "POST",
                data: {
                    text: text,
                    lang: lang,
                    _token: "{{ csrf_token() }}"
                },
                beforeSend: function() {
                    $('#result').html("Translating...");
                },
                success: function(response) {
                    $('#result').html(response.translation);
                },
                error: function() {
                    $('#result').html("<span class='text-red-400'>Translation failed!</span>");
                }
            });
        });
    </script>

</body>

</html>
