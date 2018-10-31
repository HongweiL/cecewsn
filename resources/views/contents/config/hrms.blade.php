@extends('layouts.sidebar')

@section('content')
    <link rel="stylesheet" href="css/acquisition.css">
    <script src="layui/layui.js"></script>
    <div class="container" style="padding: 30px;">
        <div class="layui-row" style="margin: 4px;">
            <div class="layui-col-md2">
                <button class="layui-btn layui-btn" onclick="openNew()">New</button>
            </div>
        </div>
        <div>
            <table id="table"  lay-data="{id: 'table'}" lay-filter="useruv">
            </table>
        </div>
    </div>
    <div id="data" style="display: none">
        <form id="new-form" class="layui-form" action="" style="width: 70%; margin:auto">
            <div class="layui-form-item">
                <div style="margin-top: 20px;">
                    <label class="layui-form-label" for="input-brand">Brand: </label>
                    <input name="brand" id="input-brand" value="" class="layui-input" lay-verify="required" autocomplete="off">
                    <input name="id" id="input-id" value="" class="layui-input" lay-verify="required" autocomplete="off" style="display: none;">
                </div>
            </div>
            <div class="layui-form-item">
                <div style="margin-top: 20px;">
                    <label class="layui-form-label" for="input-model">Model: </label>
                    <input name="model" id="input-model" value="" class="layui-input" lay-verify="required" autocomplete="off">
                </div>
            </div>
            <div class="layui-form-item">
                <div style="margin-top: 20px;">
                    <label class="layui-form-label" for="input-class">Class: </label>
                    <input name="class" id="input-class" value="" class="layui-input" lay-verify="required" autocomplete="off">
                </div>
            </div>
            <div class="layui-form-item">
                <div style="margin-top: 20px;">
                    <label class="layui-form-label" for="input-sources">Sources: </label>
                    <input name="sources" id="input-sources" value="" class="layui-input" lay-verify="required" autocomplete="off">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block" style="margin-top: 20px;">
                    <button id="input-add-btn" value="" class="layui-btn" lay-submit lay-filter="add" style="display: none">Ok</button>
                    <button id="input-mod-btn" value="" class="layui-btn" lay-submit lay-filter="modify" style="display: none">Save changes</button>
                </div>
            </div>
        </form>
    </div>
    <script type="text/html" id="toolBar">
        <a class="layui-btn  layui-btn-sm layui-btn-normal" lay-event="mod" id="mod">Modify</a>
    </script>
    <script>
        function openNew() {
            $("#input-add-btn").show();
            $("#input-mod-btn").hide();
            layer.open({
                title: "",
                type:1,
                closeBtn:1,
                area:['500px', '500px'],
                shift:7,
                content: $("#data").html()
            });
        }
        layui.use(['table', 'form'], function(){
            var table = layui.table;
            var form = layui.form;
            table.render({
                elem: '#table'
                ,url:'/getHRMS'
                ,cellMinWidth: 100
                ,loading:true
                ,height:"full-140"
                ,cols: [[
                    {field:'useruv', title: 'Action', width:100,toolbar:"#toolBar"}
                    ,{field:'id', width:80, title: 'ID', sort: true}
                    ,{field:'brand', title: 'Brand', width: '20%', sort: true}
                    ,{field:'model', title: 'Model', width: '20%', sort: true}
                    ,{field:'class', title: 'Class', width: '20%', sort: true}
                    ,{field:'sources', title: 'Sources', width: '20%', sort: true}
                ]]
            });
            table.on('tool(useruv)', function(obj) {
                if(obj.event==='mod') {
                    $("#input-add-btn").hide();
                    $("#input-mod-btn").show();
                    layer.open({
                        title: "",
                        type:1,
                        closeBtn:1,
                        area:['500px', '500px'],
                        shift:7,
                        content: $("#data").html()
                    });
                    $("input[id=input-brand]").val(obj.data.brand);
                    $("input[id=input-model]").val(obj.data.model);
                    $("input[id=input-class]").val(obj.data.class);
                    $("input[id=input-sources]").val(obj.data.sources);
                    $("input[name=id]").val(obj.data.id);
                }
            });
            form.on('submit(add)', function(data){
                $.ajax({
                    type: "GET",
                    url: "addHRMS",
                    data:data.field,
                });
                layer.msg("Added");
                layer.closeAll();
                setTimeout(function () {
                    table.reload("table");
                }, 500);
                return false;
            });
            form.on('submit(modify)', function(data){
                $.ajax({
                    type: "GET",
                    url: "modHRMS",
                    data:data.field,
                    success:function() {
                        layer.msg("Saved");
                        setTimeout(function () {
                            table.reload("table");
                        }, 500);
                    }
                });
                layer.closeAll();
                return false;
            });
        });
    </script>
@endsection