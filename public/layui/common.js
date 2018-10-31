/**
 * Created by Administrator on 2017/10/24.
 */

/**
 * 利用layer弹出交互框
 * @param title
 * @param width
 * @param height
 * @param content DOM 元素 栗子$('#form_div')
 */
function show_layer(title, width, height, content) {
    if (title == null || title == '') {
        title = false;
    };

    if (width == null || width == '') {
        width = ($(window).width() * 0.9);
    };
    if (height == null || height == '') {
        height = ($(window).height() - 50);
    };
    layer.open({
        offset: '100px', //右下角弹出
        type: 1,
        area: [width+'px', height+'px'],
        fix: false, //不固定
        maxmin: true,
        shadeClose: true,
        shade:0.4,
        title: title,
        content: content // $('#form_div')
    });
}
