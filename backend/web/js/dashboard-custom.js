
$(document).ready(function() {
    // Locations
    $('#us2').locationpicker({
    location: {latitude: 46.15242437752303, longitude: 2.7470703125},   
    radius: 0,
    inputBinding: {
        latitudeInput: $('#us2-lat'),
        longitudeInput: $('#us2-lon'),
    }
    });
    // Button Modal
    $('.btn-ajax-modal').click(function (){
        var elm = $(this),
            target = elm.attr('data-target'),
            ajax_body = elm.attr('value');

        $(target).modal('show')
            .find('.custom-modal-text')
            .load(ajax_body);
    });

    // File Input in form
    $(function(){
    $("[type=file]").on("change", function(){
        var file = this.files[0];
        var formdata = new FormData();
        formdata.append("file", file);
        $('#info').slideDown();
        if(file.name.length >= 30){
          $('#name span').empty().append(file.name.substr(0,30) + '..');
        }else {
          $('#name span').empty().append(file.name);
        }
        if(file.size >= 1073741824){
                $('#size span').empty().append(Math.round(file.size/1073741824) + "GB");
            }else if(file.size >= 1048576){
                $('#size span').empty().append(Math.round(file.size/1048576) + "MB");
            }else if(file.size >= 1024){
                $('#size span').empty().append(Math.round(file.size/1024) + "KB");
            }else {
                $('#size span').empty().append(Math.round(file.size) + "B");
            }
        $('#type span').empty().append (file.type);
        if(file.name.length >= 30){
            $('.file label').text("Chosen : " + file.name.substr(0,30) + '..');
        }else {
            $('.file label').text("Chosen : " + file.name);
        }

        var ext = $('#file').val().split('.').pop().toLowerCase();
        if($.inArray(ext, ['php', 'html']) !== -1) {
        $('#info').hide();
        $('label').text('Choose File');
        $('#file').val('');
        alert('This file extension is not allowed!');
        }
        });
        });
        });
        $(function () {
        $(".grid").sortable({
        tolerance: 'pointer',
        revert: 'invalid',
        placeholder: 'span2 well placeholder tile',
        forceHelperSize: true
    });
    // Custom Right Sidebar Tab
    $(document).ready(function() {
        $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
            e.preventDefault();
            $(this).siblings('a.active').removeClass("active");
            $(this).addClass("active");
            var index = $(this).index();
            $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
            $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
        });
    });
});
