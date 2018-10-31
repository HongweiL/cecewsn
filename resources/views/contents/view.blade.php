@extends('layouts.sidebar')

@section('content')
    <div style="height: 100%;">
        <table id="table"  lay-data="{id: 'table'}" lay-filter="useruv">
        </table>
    </div>
    <script src="layui/layui.js"></script>
    <script type="text/html" id="toolBar">
        <a class="layui-btn  layui-btn-sm" lay-event="download" id="dl">Open</a>
    </script>
    <script src="js/download.js"></script>
    <script>
        function downloadFile(option, name) {
            var url;
            if (option) {
                url = '/dljob1';
            } else {
                url = '/dljob2';
            }
            $.ajax({
                url: url,
                method:"GET",
                data:{name:name},
                success: function(link) {
                    location.href = link;
                }
            })
        }
        layui.use(['table'], function(){
            var table = layui.table;
            table.render({
                elem: '#table'
                ,url:'/getJobList'
                ,cellMinWidth: 80
                ,loading:true
                ,height:"full-20"
                ,cols: [[
                    {field:'useruv', title: 'Option', width:"10%",toolbar:"#toolBar"}
                    ,{field:'job_id', width:"7%", title: 'Job ID', sort: true}
                    ,{field:'job_name', width:"13%", title: 'Name'}
                    ,{field:'finished', width:"10%", title: 'Status'}
                    ,{field:'loc', width:"15%", title: 'Sample location'}
                    ,{field:'type', width:"15%", title: 'Sample type'}
                    ,{field:'date', width:"15%", title: 'Sample date'}
                    ,{field:'create_time', title: 'Uploaded at', width: '15%', sort: true}
                ]]
            });
            table.on('tool(useruv)', function(obj) {
                if (obj.data.finished != "Pending") {
                    var content = '<div style="margin-top:50px;text-align:center"><button class="layui-btn" onclick="downloadFile(true, \''+obj.data.job_name+'\')">Import result</button>';
                    if (obj.data.finished == 'Finished') {
                        content += '<button class="layui-btn" onclick="downloadFile(false, \''+obj.data.job_name+'\')">Search result</button></div>';
                    } else {
                        content += '<p style="margin-top:30px">Please upload adducts file to process data with search method.</p></div>'
                    }
                    layer.open({
                        type: 1,
                        skin: 'layui-layer-rim',
                        title: 'Download option',
                        area: ['420px', '240px'],
                        content: content
                    });
                } else {
                    layer.msg("Please wait until data is processed...")
                }
            });
        });
    </script>
@endsection
