<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google search bar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="search">
        <label for="searchBar">Google request</label>
        <input type="text" id="searchBar" name="searchBar"><br>
        <button type="button" onclick="search()">Request</button>
    </div>
    <div id="result" style="font-family: monospace;white-space: pre;">
    </div>

    <script>
        function search() {
            var xhttp = new XMLHttpRequest();
            /****** ADD CALLBACK ******/
            xhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    /****** PRINT RESULT ******/
                    document.querySelector('#result').innerHTML = (JSON.stringify(JSON.parse(this.responseText),null,'\t'));

                    /****** EXPORT TO FILE ******/
                    const filename = 'output.json';
                    const jsonStr = JSON.stringify(JSON.parse(this.responseText),null,'\t');
                    let element = document.createElement('a');
                    element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(jsonStr));
                    element.setAttribute('download', filename);
                    element.style.display = 'none';
                    document.body.appendChild(element);
                    element.click();
                    document.body.removeChild(element);
                    /****** END EXPORT ******/
                }
            };

            /****** PARAMETERS ******/
            var q = document.querySelector('#searchBar').value;
            var url = 'https://www.googleapis.com/customsearch/v1';
            var key =  'AIzaSyBlJ9s_aQ7tzUNqsQy9zYIuEY2Bb7mUAwI';
            var cx = '017576662512468239146:omuauf_lfve';
            var apiRequest = url + '?key=' + key + '&cx=' + cx + '&q=' + q;

            /****** EXECUTE REQUEST ******/
            xhttp.open("GET", apiRequest, true);
            xhttp.send();
        }
    </script>
</body>
</html>