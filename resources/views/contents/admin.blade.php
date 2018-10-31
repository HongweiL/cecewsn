@extends('layouts.sidebar')

@section('content')
    <div>
        <table id="table"  lay-data="{id: 'table'}" lay-filter="useruv">
        </table>
    </div>
    <script src="layui/layui.js"></script>
    <script type="text/html" id="toolBar">
        <a class="layui-btn  layui-btn-sm layui-btn-normal" lay-event="appr" id="appr">Activate</a>
        <a class="layui-btn layui-btn-sm layui-btn-danger" lay-event="deact" id="deact">Deactivate</a>
    </script>
    <script>
        layui.use(['table'], function(){
            var table = layui.table;
            table.render({
                elem: '#table'
                ,url:'/getUserList'
                ,cellMinWidth: 80
                ,loading:true
                ,height:"full-20"
                ,cols: [[
                    {field:'useruv', title: 'Action', width:200,toolbar:"#toolBar"}
                    ,{field:'id', width:80, title: 'ID', sort: true}
                    ,{field:'role', width:100, title: 'status', sort: true}
                    ,{field:'fname', title: 'First Name', width: '10%'}
                    ,{field:'lname', title: 'Last Name', width: '10%'}
                    ,{field:'affiliation', title: 'Affiliation', width: '15%', minWidth: 100}
                    ,{field:'email', title: 'Email', width: '20%'}
                    ,{field:'created_at', title: 'Joined at', width: 200, sort: true}
                ]]
            });
            table.on('tool(useruv)', function(obj) {
                if(obj.event==='appr') {
                    layer.confirm('Would you like to grant application access to this user?', {
                        title: "Confirm",
                        btn: ['Yes','No']
                    }, function(){
                        $.ajax({
                            type: 'GET',
                            url: '/manage',
                            async : 'false',
                            data:{id:obj.data.id, action:1},
                            dataType:'json',
                            success: function(msg){
                                layer.msg(msg.data, {icon: 1});
                                setTimeout(function () {
                                    table.reload("table");
                                }, 500);
                            }
                        });
                    }, function(){});
                } else if (obj.event==='deact') {
                    layer.confirm('Would you like to revoke permissions of this user account?', {
                        title: "Confirm",
                        btn: ['Yes','No']
                    }, function(){
                        $.ajax({
                            type: 'GET',
                            url: '/manage',
                            data:{id:obj.data.id, action:2},
                            dataType:'json',
                            success: function(msg){
                                layer.msg(msg.data, {icon: 1});
                                setTimeout(function () {
                                    table.reload("table");
                                }, 500);
                            }
                        });
                    }, function(){});
                }
            });
        });
    </script>
@endsection