  $('ul#search_from_location li').live('click', function () {
        $('#fromSearch').val($(this).html());
        $('#loc_id').val($(this).attr('rel'));
        searchResult($(this).attr('rel'))
        $('#search_from_location').hide();
    });
    $('#fromSearch').live('keyup', function (e) {
        if (e.keyCode == 13) {
            $('#loc_id').val($('#search_from_location').find('.selected').attr('rel'));
            $('#fromSearch').val($('#search_from_location').find('.selected').html());
            searchResult($('#search_from_location').find('.selected').attr('rel'));
            $('#search_from_location').hide();

        } else {
            if (e.keyCode != 40 && e.keyCode != 38) {
                var keyword = $('#fromSearch').val();
                if (keyword == '') {
                    $('#search_from_location').hide();
                    return false;
                }
                var data = {keyword: keyword}
                $.ajax({
                    type: "POST",
                    data: data,
                    url: 'home/search_location',
                    dataType: "text",
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        //alert ("Ajax Error: " + XMLHttpRequest.responseText + "\nTextStatus: " + textStatus + "\nErrorThrown: " + errorThrown);
                    },
                    success: function (data) {
                        if (data != '') {
                            // if (e.keyCode != 40 && e.keyCode != 38) { 
                            chosen = -1;
                            // }
                            $('#search_from_location').show();
                            $('#search_from_location').html(data);
                        } else {
                            $('#search_from_location').hide();
                        }
                    }
                });

            } else {
                var dropdown = '#search_from_location';
                if (e.keyCode == 40) {
                    if (chosen === "") {
                        chosen = 0;
                    } else if ((chosen + 1) < $('#search_from_location li').length) {
                        chosen++;
                    }
                    $('#search_from_location li').removeClass('selected');
                    $('#search_from_location li:eq(' + chosen + ')').addClass('selected');
                    var selectedTop = $('.selected').offset().top;
                    //alert(selectedTop)
                    var selectedBottom = selectedTop + $('#search_from_location li:eq(' + chosen + ')').outerHeight();
                    var ddTop = $(dropdown).offset().top
                    var ddBottom = ddTop + $(dropdown).outerHeight();
                    var ddScrollTop = $(dropdown).scrollTop();

                    if (selectedBottom > ddBottom) {
                        $(dropdown).scrollTop(ddScrollTop + (selectedBottom - ddBottom));
                    } else if (ddTop > selectedTop) {
                        $(dropdown).scrollTop(ddScrollTop + (selectedTop - ddTop));
                    }
                    return false;
                }
                if (e.keyCode == 38) {
                    if (chosen === "") {
                        chosen = 0;
                    } else if (chosen > 0) {
                        chosen--;
                    }
                    $('#search_from_location li').removeClass('selected');
                    $('#search_from_location li:eq(' + chosen + ')').addClass('selected');
                    var selectedTop = $('.selected').offset().top;

                    var selectedBottom = selectedTop + $('#search_from_location li:eq(' + chosen + ')').outerHeight();
                    var ddTop = $(dropdown).offset().top
                    var ddBottom = ddTop + $(dropdown).outerHeight();
                    var ddScrollTop = $(dropdown).scrollTop();

                    if (selectedBottom > ddBottom) {
                        $(dropdown).scrollTop(ddScrollTop + (selectedBottom - ddBottom));
                    } else if (ddTop > selectedTop) {
                        $(dropdown).scrollTop(ddScrollTop + (selectedTop - ddTop));
                    }
                    return false;
                }
            }
        }
    });
    
    function searchResult(id){
          var data = {keyword: id}
                $.ajax({
                    type: "POST",
                    data: data,
                    url: 'home/searchResult',
                    dataType: "JSON",
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        //alert ("Ajax Error: " + XMLHttpRequest.responseText + "\nTextStatus: " + textStatus + "\nErrorThrown: " + errorThrown);
                    },
                    success: function (data) {
                        if (data.msg == 'success') {
                            var str = '';
                         var route = data.data;
//                        $(data.data).each(function(row,value){
//                            $(value).each(function(i,val){
//                                if(i==0)
//                                route +='<div class="row'+Number(i+1)+' new-row"></div>';
//                            else
//                                route +='<div class="row'+Number(i+1)+'"></div>';
//                            });
//                        });
                        $('.search_get_down').html(route);
                        } else {
                       $('.search_get_down').html('No Data Found');
                        }
                    }
                });
    }