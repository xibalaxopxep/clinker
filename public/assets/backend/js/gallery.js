
$('#modal_default').on('show.bs.modal', function () {
    getTags();
})
function addTag(i, result, pos_x, pos_y) {
//      var image = document.getElementById("gallery-basic");
    var tag = $("<div class='tagged'></div>")[0];
    position_x = pos_x / image.width;
    position_y = pos_y / image.height;
    tag.style.left = (pos_x - 13).toString() + 'px';
    tag.style.top = (pos_y - 13).toString() + 'px';
    tag.style.visibility = "visible";
    $('#tag_count').text(i + 1);
    tag.title = result;

    //tag.innerHTML = '<span class="newly-added">' + (i + 1) + '</span>';
    $('#tagged').append(tag);
    //$('#tagged .newly-added').parent().draggable().find('span').removeClass('newly-added');

    $.ajax({
        url: '/api/save-tag',
        method: 'POST',
        data: {gallery_id: image.dataset.key, image: $(image).attr('src'), title: result, position_x: position_x, position_y: position_y},
        success: function (resp) {
            if (resp.success) {
                getTags();
            } else {
                var n = noty({text: resp.message, type: 'warning'});
            }
        }
    })
}
function clickcoord(event) {
    bootbox.prompt("Tiêu đề thẻ", function (result) {
        if (result) {
            var i = parseInt($('#tag_count').text() || 1);
            var image = document.getElementById("gallery-basic");
            var pos_x = event.offsetX ? (event.offsetX) : event.pageX - image.offsetLeft;
            var pos_y = event.offsetY ? (event.offsetY) : event.pageY - image.offsetTop;
            addTag(i, result, pos_x - 13, pos_y - 13);
        }
    });
}
var image = document.getElementById('gallery-basic');
function showTags(images) {/*
 var images = [
 {title:'This is a tree',position_x:0.19,position_y:0.4},
 {title:'Pretty sure this is also a tree',position_x:0.5,position_y:0.3},
 {title:'Can you guess this one?',position_x:0.775,position_y:0.5},
 ];*/
    $('#tagged .tagged').remove();
    image = document.getElementById('gallery-basic');// document.getElementById('gallery-basic');
    var options = {};
    var data = [];
    for (i = 0; i < images.length; i++) {
        data.push(
                Taggd.Tag.createFromObject({
                    position: {
                        x: images[i].position_x,
                        y: images[i].position_y
                    },
                    text: images[i].title,
                })
                );
    }
    var taggd = new Taggd(image, options, data);
    $('.taggd .taggd__wrapper').each(function (index, e) {
        $(this).attr('ondblclick', "editTag(this)");
        $(this).attr('title', images[index].title);
        $(this).attr('data-key', images[index].id);
        $(this).appendTo('#tagged');
    });
    $('#tagged > div').removeClass('taggd__wrapper').addClass('tagged').addClass('draggable');

    $(".draggable").draggable();
}
function getTags(images) {
    $.ajax({
        url: '/api/get-tags',
        method: 'POST',
        data: {gallery_id: $('#gallery-basic').data('key')},
        success: function (resp) {
            //resp = JSON.parse(resp);
            if (resp.success) {
                showTags(resp.records);
                $('.count-tag').text('Gắn thẻ ảnh (' + resp.records.length + ')');
            }
        }
    });
}
function editTag(elm) {
    bootbox.prompt({
        title: "Sửa tiêu đề thẻ",
        value: elm.title,
        callback: function (result) {
            if (result) {
                $.ajax({
                    url: '/api/update-tag',
                    method: 'POST',
                    data: {id: elm.dataset.key, title: result},
                    success: function (resp) {
                        if (resp.success) {
                            $(elm).attr('title', result);
                        } 
                    }
                })
            }
        }
    }
    );
}
var menu = new BootstrapMenu('.tagged', {
    actions: [{
            name: 'Xóa tag',
            iconClass: 'icon-trash',
            onClick: function (row) {
                console.log(row);
            },
        },
    ]
});
function deleteTag($item) {
    $.ajax({
        url: '/api/remove-tag',
        method: 'POST',
        data: {id: $item.data('key')},
        success: function (resp) {
            if (resp.success) {
                $item.fadeOut();
            }
        }
    });
}
$(function () {
    $("#droppable").droppable({
        classes: {
            "ui-droppable-active": "ui-state-highlight"
        },
        drop: function (event, ui) {
            bootbox.confirm("Bạn có chắc chắn muốn xóa?", function (result) {
                if (result === true) {
                    deleteTag(ui.draggable);
                }
            });
        }
    });
})
/*
$('.new-image').click(function(){
    var src = $('[name="images"]').attr('value');
    $('#gallery-basic').attr('src', src);
    $('#gallery-basic').attr('data-key', '0');
})*/