<!doctype html>
<html lang="nl">
<head>
    <title>Minidagboek</title>
</head>
<body>
    <form id="testform">
        <label>datum: </label>
        <input id="1" type="text" name="datum">
        <label>weekdag: </label>
        <input id="2" type="text" name="weekdag">
        <label>muziek: </label>
        <input id="3" type="text" name="muziek">
        <label>gebeurtenis: </label>
        <input id="4" type="text" name="gebeurtenis">
    </form>
        <button onclick="test()">UPLOAD ENTRY</button>
        <br><br><br><br><br>

    <div id="xd">

        <label>GET dag: </label>
        <input id="5" type="text" name="getdatum">
        <button onclick="test2()">GET ENTRY</button>

    </div>

    <div id="xdd">

        <label>TYP HIER EWA: </label>
        <textarea id="6"></textarea>
        <button onclick="test3()">UPLOAD TEXTAREA</button>

    </div>

    <br><br><br><br><br>
    
    <div id="xddd">

        <form action="myform.cgi">
            <input type="file" name="fileupload" value="fileupload" id="7">
            <label for="fileupload"> Select a file to upload</label>
        </form>
        <button onclick="test4()">STUUR FILE</button>

    </div>
    <br><br><br><br><br>
    {!!$md->gebeurtenis or ""!!}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="/js/lifeoftaltiko.min.js"></script>
</body>
</html>