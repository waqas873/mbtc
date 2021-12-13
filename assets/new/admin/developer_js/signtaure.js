$(function(){

    "use strict";

    /* LOAD CANVAS FOR SIGNATURE IF EXISTS */
    function cropCanvas(canvas){
        var croppedCanvas = document.createElement('canvas');
        var croppedCtx = croppedCanvas.getContext('2d');
        croppedCanvas.width  = canvas.width;
        croppedCanvas.height = canvas.height;
        croppedCtx.drawImage(canvas, 0, 0);

        var w = croppedCanvas.width;
        var h = croppedCanvas.height;
        var pix = {x:[], y:[]};
        var imageData = croppedCtx.getImageData(0,0,croppedCanvas.width,croppedCanvas.height);
        var x, y, index;

        for(y = 0; y < h; y++){
            for(x = 0; x < w; x++){
                index = (y * w + x) * 4;
                if(imageData.data[index+3] > 0){
                    pix.x.push(x);
                    pix.y.push(y);
                }
            }
        }
        pix.x.sort(function(a,b){ return a-b; });
        pix.y.sort(function(a,b){ return a-b; });
        var n = pix.x.length-1;

        w = pix.x[n] - pix.x[0];
        h = pix.y[n] - pix.y[0];
        var cut = croppedCtx.getImageData(pix.x[0], pix.y[0], w, h);

        croppedCanvas.width = w;
        croppedCanvas.height = h;
        croppedCtx.putImageData(cut, 0, 0);

        return croppedCanvas.toDataURL();
    }
    function resizePPICanvas(canvas,sigPad,clear) {
        var ratio =  Math.max(window.devicePixelRatio || 1, 1);
         if(canvas.offsetWidth * ratio==0){
             canvas.width = 922;
         }else{
             canvas.width = canvas.offsetWidth * ratio;
         }
        if(canvas.offsetHeight * ratio==0){
            canvas.height = 200;
        }else{
            canvas.height = canvas.offsetHeight * ratio;
        }

        canvas.getContext("2d").scale(ratio, ratio);
        if(clear){
            $('a.clear_sig').trigger("click");
            $('a.clear_sig_joint').trigger("click");
        }
    }
    /* CREATE PPI SIGNATURE PAD */
    if($('#company_signature').length>0){
        var canvas_main = document.querySelector("#company_signature");
        //canvas_main.addEventListener( 'touchstart', onTouchStart, false);
        var signaturePad_main = new SignaturePad(canvas_main,{
            minWidth:1,
            maxWidth:2,
            throttle:0,
            minDistance: 1,
            penColor: '#494949'
        });
        //resize canvas on load, before repopulating with image
        resizePPICanvas(canvas_main,signaturePad_main,false);
        if($('input[name="signature"]').val()){
            signaturePad_main.fromDataURL($('input[name="signature"]').val(),
                {
                    width: $('#company_signature').width(),
                    height: $('#company_signature').height()
                });
            signaturePad_main.off();
            $('#company_signature').css('background-color', '#ccc');
        }
        $(window).resize(function(){
            resizePPICanvas(canvas_main,signaturePad_main,true);
        });
        $('a.clear_sig').click(function(){
            $('input[name="signature"]').val('');
            $('input[name="signature_c"]').val('');
            signaturePad_main.on();
            signaturePad_main.clear();
            $('#company_signature').css('background-color', '#fff');
        });
        $('a.confirm_sig').click(function(){
            $('input[name="signature_c"]').val(cropCanvas(canvas_main));
            $('input[name="signature"]').val(signaturePad_main.toDataURL());
            signaturePad_main.off();
            $('#company_signature').css('background-color', '#ccc');
        });
    }

    if($('#site_employee_signature').length>0){
        var site_employee_canvas_main = document.querySelector("#site_employee_signature");
        //site_employee_canvas_main.addEventListener( 'touchstart', onTouchStart, false);
        var site_employee_signaturePad_main = new SignaturePad(site_employee_canvas_main,{
            minWidth:1,
            maxWidth:2,
            throttle:0,
            minDistance: 1,
            penColor: '#494949'
        });
        //resize canvas on load, before repopulating with image
        resizePPICanvas(site_employee_canvas_main,site_employee_signaturePad_main,false);
        if($('input[name="site_employee_signature"]').val()){
            site_employee_signaturePad_main.fromDataURL($('input[name="site_employee_signature"]').val(),
                {
                    width: $('#site_employee_signature').width(),
                    height: $('#site_employee_signature').height()
                });
            site_employee_signaturePad_main.off();
            $('#site_employee_signature').css('background-color', '#ccc');
        }
        $(window).resize(function(){
            resizePPICanvas(site_employee_canvas_main,site_employee_signaturePad_main,true);
        });
        $('a.clear_site_employee_signature').click(function(){
            $('input[name="site_employee_signature"]').val('');
            //$('input[name="site_employee_signature_c"]').val('');
            site_employee_signaturePad_main.on();
            site_employee_signaturePad_main.clear();
            $('#site_employee_signature').css('background-color', '#fff');
        });
        $('a.confirm_site_employee_signature').click(function(){
            //$('input[name="site_employee_signature_c"]').val(cropCanvas(canvas_main));
            $('input[name="site_employee_signature"]').val(site_employee_signaturePad_main.toDataURL());
            site_employee_signaturePad_main.off();
            $('#site_employee_signature').css('background-color', '#ccc');
        });
    }

    if($('#site_manager_signature').length>0){
        var site_manager_canvas_main = document.querySelector("#site_manager_signature");
        var site_manager_signaturePad_main = new SignaturePad(site_manager_canvas_main,{
            minWidth:1,
            maxWidth:2,
            throttle:0,
            minDistance: 1,
            penColor: '#494949'
        });
        //resize canvas on load, before repopulating with image
        resizePPICanvas(site_manager_canvas_main,site_manager_signaturePad_main,false);
        if($('input[name="site_manager_signature"]').val()){
            site_manager_signaturePad_main.fromDataURL($('input[name="site_manager_signature"]').val(),
                {
                    width: $('#site_manager_signature').width(),
                    height: $('#site_manager_signature').height()
                });
            site_manager_signaturePad_main.off();
            $('#site_manager_signature').css('background-color', '#ccc');
        }
        $(window).resize(function(){
            resizePPICanvas(site_manager_canvas_main,site_manager_signaturePad_main,true);
        });
        $('a.clear_site_manager_signature').click(function(){
            $('input[name="site_manager_signature"]').val('');
            //$('input[name="site_manager_signature_c"]').val('');
            site_manager_signaturePad_main.on();
            site_manager_signaturePad_main.clear();
            $('#site_manager_signature').css('background-color', '#fff');
        });
        $('a.confirm_site_manager_signature').click(function(){
            //$('input[name="site_manager_signature_c"]').val(cropCanvas(canvas_main));
            $('input[name="site_manager_signature"]').val(site_manager_signaturePad_main.toDataURL());
            site_manager_signaturePad_main.off();
            $('#site_manager_signature').css('background-color', '#ccc');
        });
    }

    if($('#venue_employee_signature').length>0){
        var venue_employee_canvas_main = document.querySelector("#venue_employee_signature");
        var venue_employee_signaturePad_main = new SignaturePad(venue_employee_canvas_main,{
            minWidth:1,
            maxWidth:2,
            throttle:0,
            minDistance: 1,
            penColor: '#494949'
        });
        //resize canvas on load, before repopulating with image
        resizePPICanvas(venue_employee_canvas_main,venue_employee_signaturePad_main,false);
        if($('input[name="venue_employee_signature"]').val()){
            venue_employee_signaturePad_main.fromDataURL($('input[name="venue_employee_signature"]').val(),
                {
                    width: $('#venue_employee_signature').width(),
                    height: $('#venue_employee_signature').height()
                });
            venue_employee_signaturePad_main.off();
            $('#venue_employee_signature').css('background-color', '#ccc');
        }
        $(window).resize(function(){
            resizePPICanvas(venue_employee_canvas_main,venue_employee_signaturePad_main,true);
        });
        $('a.clear_venue_employee_signature').click(function(){
            $('input[name="venue_employee_signature"]').val('');
            //$('input[name="venue_employee_signature_c"]').val('');
            venue_employee_signaturePad_main.on();
            venue_employee_signaturePad_main.clear();
            $('#venue_employee_signature').css('background-color', '#fff');
        });
        $('a.confirm_venue_employee_signature').click(function(){
            //$('input[name="venue_employee_signature_c"]').val(cropCanvas(canvas_main));
            $('input[name="venue_employee_signature"]').val(venue_employee_signaturePad_main.toDataURL());
            venue_employee_signaturePad_main.off();
            $('#venue_employee_signature').css('background-color', '#ccc');
        });
    }

    if($('#venue_manager_signature').length>0){
        var venue_manager_canvas_main = document.querySelector("#venue_manager_signature");
        var venue_manager_signaturePad_main = new SignaturePad(venue_manager_canvas_main,{
            minWidth:1,
            maxWidth:2,
            throttle:0,
            minDistance: 1,
            penColor: '#494949'
        });
        //resize canvas on load, before repopulating with image
        resizePPICanvas(venue_manager_canvas_main,venue_manager_signaturePad_main,false);
        if($('input[name="venue_manager_signature"]').val()){
            venue_manager_signaturePad_main.fromDataURL($('input[name="venue_manager_signature"]').val(),
                {
                    width: $('#venue_manager_signature').width(),
                    height: $('#venue_manager_signature').height()
                });
            venue_manager_signaturePad_main.off();
            $('#venue_manager_signature').css('background-color', '#ccc');
        }
        $(window).resize(function(){
            resizePPICanvas(venue_manager_canvas_main,venue_manager_signaturePad_main,true);
        });
        $('a.clear_venue_manager_signature').click(function(){
            $('input[name="venue_manager_signature"]').val('');
            //$('input[name="venue_manager_signature_c"]').val('');
            venue_manager_signaturePad_main.on();
            venue_manager_signaturePad_main.clear();
            $('#venue_manager_signature').css('background-color', '#fff');
        });
        $('a.confirm_venue_manager_signature').click(function(){
            //$('input[name="venue_manager_signature_c"]').val(cropCanvas(canvas_main));
            $('input[name="venue_manager_signature"]').val(venue_manager_signaturePad_main.toDataURL());
            venue_manager_signaturePad_main.off();
            $('#venue_manager_signature').css('background-color', '#ccc');
        });
    }

});