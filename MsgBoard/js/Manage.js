/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function delet(del_id) {
    if (confirm("delete?") === true) {
        var xmlHttp;
        xmlHttp = GetXmlHttpObject();
        if (xmlHttp === null)
        {
            alert("Browser does not support HTTP Request");
            return;
        }
        var url = "delete.php";
        url = url + "?q=" + del_id;
        url = url + "&sid=" + Math.random();
        xmlHttp.onreadystatechange = stateChanged;
        xmlHttp.open("GET", url, true);
        xmlHttp.send(null);
        alert("OK!");
        location.reload();
    }
}

function reply(reply_id) {
    var xmlHttp;
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp === null)
    {
        alert("Browser does not support HTTP Request");
        return;
    }
    var url = "reply.php";
    url = url + "?q=" + reply_id;
    url = url + "&sid=" + Math.random();
    xmlHttp.onreadystatechange = stateChanged;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
    location.href=url;
}


function stateChanged()
{
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {
        document.getElementById("txtHint").innerHTML = xmlHttp.responseText;
    }
}

function GetXmlHttpObject()
{
    var xmlHttp = null;
    try
    {
        // Firefox, Opera 8.0+, Safari
        xmlHttp = new XMLHttpRequest();
    }
    catch (e)
    {
        //Internet Explorer
        try
        {
            xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e)
        {
            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
    return xmlHttp;
}