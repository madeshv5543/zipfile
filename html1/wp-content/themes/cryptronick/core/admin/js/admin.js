"use strict";

// Popup
function cryptronick_show_admin_pop(cryptronick_message_text, cryptronick_message_type) {
    // Success - cryptronick_message_type = 'info_message'
    // Error - cryptronick_message_type = 'error_message'
    jQuery(".cryptronick_result_message").remove();
    jQuery("body").removeClass('active_message_popup').addClass('active_message_popup');
    jQuery("body").append("<div class='cryptronick_result_message " + cryptronick_message_type + "'>" + cryptronick_message_text + "</div>");
    var messagetimer = setTimeout(function () {
        jQuery(".cryptronick_result_message").fadeOut();
        jQuery("body").removeClass('active_message_popup');
        clearTimeout(messagetimer);
    }, 3000);
}

function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function waiting_state_start() {
    jQuery(".waiting-bg").show();
}

function waiting_state_end() {
    jQuery(".waiting-bg").hide();
}

// Composer Part
function cryptronick_update_slider_value(cur_obj) {
    var obj_array = [];
    cur_obj.find(".vc-slide-item").each(function () {
        var data_type = jQuery(this).attr("data-type"),
            data_url = jQuery(this).attr("data-url"),
            tmp_arr = new Object();

        tmp_arr["slide_type"] = data_type;
        tmp_arr["slide_url"] = data_url;

        if (data_type == "video") {
            var data_title = jQuery(this).attr("data-title"),
                data_caption = jQuery(this).attr("data-caption"),
                data_cover = jQuery(this).attr("data-cover");

            tmp_arr["slide_title"] = data_title;
            tmp_arr["slide_caption"] = data_caption;
            tmp_arr["slide_cover"] = data_cover;
        }

        obj_array.push(tmp_arr);
    });

    var data = {
        action: "cryptronick_get_param_value_for_slider",
        string: JSON.stringify(obj_array)
    };

    jQuery.post(ajaxurl, data, function (response) {
        cur_obj.closest(".edit_form_line").find(".wpb_vc_param_value").val(response);
    });
}

jQuery(document).on("click", ".inter_x_2", function () {
    var object_for_update = jQuery(this).closest(".bpt-slides-list");

    jQuery(this).closest("li").remove();
    cryptronick_update_slider_value(object_for_update);
});

jQuery(document).on("click", ".vc-add-slide-image", function () {
    var ul_to_append = jQuery(this).siblings(".bpt-slides-list");

    var file_frame = wp.media.frames.file_frame = wp.media({
        title: "Select Images",
        button: {
            text: "Select",
        },
        multiple: true,
        library: {
            type: "image"
        }
    });

    var itemsIDs = [];

    file_frame.on("select", function () {
        file_frame.state().get("selection").forEach(function (item, i, arr) {
            itemsIDs[itemsIDs.length] = item.id;
        });

        var data = {
            action: "cryptronick_get_vc_images_for_slider",
            ids: itemsIDs.join(","),
        }

        jQuery.post(ajaxurl, data, function (response) {
            ul_to_append.append(response);
            cryptronick_update_slider_value(ul_to_append);
        });
    });

    file_frame.open();
});

jQuery(document).on("click", ".vc-add-slide-video", function () {
    var line = "\
  <div class='vc-video-popup'>\
    <h4>Add Video</h4>\
    <p>Video URL:</p>\
    <input type='text' name='video_url'>\
    <p>Video Title:</p>\
    <input type='text' name='video_title'>\
    <p>Image Cover:</p>\
    <div class='video-image-preview' data-url=''></div>\
    <input type='button' name='select_image' value='Select'>\
    <p>Video Caption:</p>\
    <input type='text' name='video_caption'>\
    <p></p>\
    <input type='button' name='cancel_vc_video_popup' value='Cancel'>\
    <input type='button' name='save_vc_video_popup' value='Save'>\
  </div>";


    if (!jQuery(this).siblings(".vc-video-popup").length)
        jQuery(this).siblings(".bpt-slides-list").after(line);
});

jQuery(document).on("click", "input[name='cancel_vc_video_popup']", function () {
    jQuery(this).closest(".vc-video-popup").siblings(".bpt-slides-list").show();
    jQuery(this).closest(".vc-video-popup").remove();
});

jQuery(document).on("click", "input[name='select_image'], .video-image-preview", function () {
    var div_to_append = jQuery(this).closest(".vc-video-popup").find(".video-image-preview");

    var file_frame = wp.media.frames.file_frame = wp.media({
        title: "Select Images",
        button: {
            text: "Select",
        },
        multiple: false,
        library: {
            type: "image"
        }
    });

    var itemsIDs = [];

    file_frame.on("select", function () {
        var cryptronick_image_attachment = file_frame.state().get("selection").first().toJSON();

        var data = {
            action: "cryptronick_get_vc_image_for_video_cover",
            url: cryptronick_image_attachment.url,
        }

        jQuery.post(ajaxurl, data, function (response) {
            div_to_append.attr("data-url", cryptronick_image_attachment.url).html(response);
        });
    });

    file_frame.open();
});

jQuery(document).on("click", "input[name='save_vc_video_popup']", function () {
    var div_to_remove = jQuery(this).closest(".vc-video-popup"),
        ul_to_append = div_to_remove.siblings(".bpt-slides-list");

    var url = div_to_remove.find("input[name='video_url']").val(),
        title = div_to_remove.find("input[name='video_title']").val(),
        image = div_to_remove.find(".video-image-preview").attr("data-url"),
        caption = div_to_remove.find("input[name='video_caption']").val();

    var data = {
        action: "cryptronick_get_vc_video_for_slider",
        url: url,
        title: title,
        image: image,
        caption: caption
    }

    jQuery.post(ajaxurl, data, function (response) {
        ul_to_append.append(response);
        div_to_remove.remove();
        cryptronick_update_slider_value(ul_to_append);
    });
});

jQuery(document).on("click", "input[name='save_vc_edit_video_popup']", function () {
    var div_to_remove = jQuery(this).closest(".vc-video-popup"),
        ul_to_append = div_to_remove.siblings(".bpt-slides-list"),
        li_to_replace = ul_to_append.find("li").eq(div_to_remove.attr("data-obj-num"));

    var url = div_to_remove.find("input[name='video_url']").val(),
        title = div_to_remove.find("input[name='video_title']").val(),
        image = div_to_remove.find(".video-image-preview").attr("data-url"),
        caption = div_to_remove.find("input[name='video_caption']").val();

    var data = {
        action: "cryptronick_get_vc_video_for_slider",
        url: url,
        title: title,
        image: image,
        caption: caption
    }

    jQuery.post(ajaxurl, data, function (response) {
        li_to_replace.replaceWith(response);
        ul_to_append.show();
        div_to_remove.remove();
        cryptronick_update_slider_value(ul_to_append);
    });
});

jQuery(document).on("click", ".inter_edit_2", function () {
    var object_for_update = jQuery(this).closest("li"),
        object_for_update_index = object_for_update.index(),
        attributes_container = object_for_update.find(".video-item"),
        url = attributes_container.attr("data-url"),
        title = attributes_container.attr("data-title"),
        image = attributes_container.attr("data-cover"),
        caption = attributes_container.attr("data-caption"),
        closest_ul = jQuery(this).closest(".bpt-slides-list");

    closest_ul.hide();

    var line = "\
  <div class='vc-video-popup' data-obj-num='" + object_for_update_index + "'>\
    <h4>Edit Video</h4>\
    <p>Video URL:</p>\
    <input type='text' name='video_url' value='" + url + "'>\
    <p>Video Title:</p>\
    <input type='text' name='video_title' value='" + title + "'>\
    <p>Image Cover:</p>\
    <div class='video-image-preview' data-url='" + image + "'></div>\
    <input type='button' name='select_image' value='Select'>\
    <p>Video Caption:</p>\
    <input type='text' name='video_caption' value='" + caption + "'>\
    <p></p>\
    <input type='button' name='cancel_vc_video_popup' value='Cancel'>\
    <input type='button' name='save_vc_edit_video_popup' value='Save'>\
  </div>";

    closest_ul.after(line);

    var data = {
        action: "cryptronick_get_vc_image_for_video_cover",
        url: image,
    }

    jQuery.post(ajaxurl, data, function (response) {
        closest_ul.siblings(".vc-video-popup").find(".video-image-preview").html(response);
    });
});
