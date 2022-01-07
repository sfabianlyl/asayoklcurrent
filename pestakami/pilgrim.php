<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require '../vendor/autoload.php';
    $panel=false;
    include '../templates/header.php';
    date_default_timezone_set ("Asia/Kuala_Lumpur");
?>


<style>
    @font-face {
        font-family: OpenSans;
        src: url("assets/fonts/OpenSans/OpenSans-Medium.ttf");
    }
    @font-face {
        font-family: DancingScript;
        src: url("assets/fonts/DancingScript/DancingScript-Bold.ttf");
    }
    @font-face {
        font-family: PoiretOne;
        src: url("assets/fonts/PoiretOne-Regular.ttf");
    }
    .canvas{
        width:50%;
        position:relative;
    }
    .canvas img{
        width:100%;
    }
    .img-text{
        position:absolute;
        transform:translateY(-50%);
        font-family:PoiretOne;
        color:#3A7175;
        font-size:200%;
    }
    .img-signature{
        position:absolute;
        transform:translate(-50%,-50%);
        font-family:DancingScript;
        color:#3A7175;
        font-size:300%;
    }
    #name-text{
        top:17%;
        left:28%;
    }
    #city-text{
        top:21.8%;
        left:28%;
    }
    #state-text{
        top:26.6%;
        left:28%;
    }
    #parish-text{
        top:31.4%;
        left:28%;
    }
    #signature-text{
        top:69%;
        left:50%;
    }
</style>

<div class="mb-5">
    <h3 class="text-center">Pilgrim Card</h3>
    <p class="text-center"><i>Fill in, download, and share your pilgrim card on social media!</i></p>
</div>

<div class="row mb-3">
    <label for=""><i>Nama (Name)</i></label>
    <input type="text" class="form-control" id="name">
</div>
<div class="row mb-3">
    <label for=""><i>Bandar (City)</i></label>
    <input type="text" class="form-control" id="city">
</div>
<div class="row mb-3">
    <label for=""><i>Negeri (State)</i></label>
    <input type="text" class="form-control" id="state">
</div>
<div class="row mb-3">
    <label for=""><i>Paroki (Parish)</i></label>
    <input type="text" class="form-control" id="parish">
</div>
<div class="row mb-3">
    <label for=""><i>Tandatangan (Signature)</i></label>
    <input type="text" class="form-control" id="signature">
</div>
<div class="text-center mb-5">
    <button class="btn btn-success" id="download" type="button">Download</button>
</div>
<div class="d-flex justify-content-center">
    <div class="canvas" id="node">
        <img src="assets/pilgrim-card-01.png" alt="">
        <span class="img-text" id="name-text"></span>
        <span class="img-text" id="city-text"></span>
        <span class="img-text" id="state-text"></span>
        <span class="img-text" id="parish-text"></span>
        <span class="img-signature" id="signature-text"></span>
    </div>
</div>


<script src="assets/domtoimg.js"></script>

<script>
    const b64toBlob = (base64String, sliceSize=512) => {
        let arr = base64String.split(',');
        let contentType = arr[0].match(/:(.*?);/)[1];
        var b64Data= arr[1];

        const byteCharacters = atob(b64Data);
        const byteArrays = [];

        for (let offset = 0; offset < byteCharacters.length; offset += sliceSize) {
            const slice = byteCharacters.slice(offset, offset + sliceSize);

            const byteNumbers = new Array(slice.length);
            for (let i = 0; i < slice.length; i++) {
            byteNumbers[i] = slice.charCodeAt(i);
            }

            const byteArray = new Uint8Array(byteNumbers);
            byteArrays.push(byteArray);
        }

        const blob = new Blob(byteArrays, {type: contentType});
        return blob;
    }
   
    function downloadBlob(blob, name = 'file.txt') {
        // Convert your blob into a Blob URL (a special url that points to an object in the browser's memory)
        const blobUrl = URL.createObjectURL(blob);

        // Create a link element
        const link = document.createElement("a");

        // Set link's href to point to the Blob URL
        link.href = blobUrl;
        link.download = name;

        // Append link to the body
        document.body.appendChild(link);

        // Dispatch click event on the link
        // This is necessary as link.click() does not work on the latest firefox
        link.dispatchEvent(
            new MouseEvent('click', { 
            bubbles: true, 
            cancelable: true, 
            view: window 
            })
        );

        // Remove link from body
        document.body.removeChild(link);
    }

    $(document).ready(function(){
        $("#name,#city,#state,#parish,#signature").on("change keyup keydown",function(){
            var text=$("#"+this.id+"-text");
            text.text($(this).val());
        }).trigger("change");

        $("#download").on("click",function(){
            var node =document.getElementById('node');
            domtoimage.toPng(node)
                .then (function (dataUrl) {
                    downloadBlob(b64toBlob(dataUrl),"pilgrim-card.png");
                })
                .catch(function (error) {
                    console.error('oops, something went wrong!', error);
                });
        });
    });
</script>

<?php
    include '../templates/footer.html';
?>