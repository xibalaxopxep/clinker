jQuery(function(){
    $("#btnSave").click(function() { 
        $('#images-product').show();
        initSaving();
        html2canvas($("#full-view")[0]).then(function(canvas) {
            theCanvas = canvas;
            canvas.toBlob(function(blob) {
                saveAs(blob, "alagreen-capture-screen.png"); 
                $('#images-product').hide();
                endSaving();
            });
        });
    });    
});