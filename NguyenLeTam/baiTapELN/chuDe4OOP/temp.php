<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <input type="radio" name="toggle"  value="element1"> Hiển thị Element 1
    <input type="radio" name="toggle"  value="element2"> Hiển thị Element 2

    <div id="element1" class="hidden">Nội dung của Element 1</div>
    <div id="element2" class="hidden">Nội dung của Element 2</div>

    <script>
        var radioButtons = document.querySelectorAll('input[type="radio"]');
        var elements = document.querySelectorAll('.hidden');

        radioButtons.forEach(function(radio) {
            radio.addEventListener('change', function() {
                elements.forEach(function(element) {
                    element.style.display = 'none';
                });

                var selectedElement = document.getElementById(radio.value);
                if (selectedElement) {
                    selectedElement.style.display = 'block';
                }
            });
        });

        radioButtons.forEach(function(radio) {
            if (radio.checked) {
                var selectedElement = document.getElementById(radio.value);
                if (selectedElement) {
                    selectedElement.style.display = 'unset';
                }
            }
        });
    </script>
</body>
</html>
