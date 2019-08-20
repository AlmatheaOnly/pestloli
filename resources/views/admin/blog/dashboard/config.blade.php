@extends('admin.blog.layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row page-title-row">
            <div class="col-md-6">
                <h3>配置
                    <small>» 列表</small>
                </h3>
            </div>
        </div>

        <div class="row" id="edit">
            <div class="col-sm-12">

                <div class="alert alert-danger" v-bind:class="isError">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>更新失败</strong>
                    @{{item.name}} 的值已更新为 @{{item.value}} 时失败
                </div>

                <div class="alert alert-success" v-bind:class="isSuccess">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>
                        <i class="fa fa-check-circle fa-lg fa-fw"></i> 更新成功.
                    </strong>
                    @{{item.name}} 的值已更新为 @{{item.value}}
                </div>

                <table id="posts-table" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>配置项</th>
                        <th>值</th>
                        <th data-sortable="false">操作</th>
                    </tr>
                    </thead>
                    <tbody v-for="config in list">
                    <tr>
                        <td>
                            @{{ config.name }}
                        </td>
                        <td>
                            <div class="col-md-12">
                                <input v-bind:readonly="config.isReadOnly" class="form-control"
                                       type="text" v-model="config.value"/>
                            </div>
                        </td>
                        <td>
                            <button @click="editAble(config)" class="btn btn-xs btn-info">
                                <i class="fa fa-edit">@{{config.status}}</i>
                            </button>
                            <button v-on:click="edit(config)" id="done" class="btn btn-xs btn-info">
                                <i class="fa fa-edit">完成</i>
                            </button>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>

    </div>
@stop

@section('scripts')
    <script>
        const edit = new Vue({
            el: '#edit',
            data: {
                list: {},
                table: {},
                value: "",
                isError: {"d-none": true},
                isSuccess: {"d-none": true},
                item: {id:"",name:"",value:""},
            },
            methods: {
                editAble(item) {
                    console.log(item);
                    if (item.isReadOnly === "readOnly") {
                        item.isReadOnly = false;
                        item.status = "取消";
                        this.value = item.value;
                    } else {
                        item.isReadOnly = "readOnly";
                        item.status = "编辑";
                        item.value = this.value;
                        this.value = "";
                    }
                },
                edit(item) {
                    $.ajax({
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{route('admin.blog.config.ajax.update')}}",
                        data: {id: item.id, name: item.name, value: item.value},
                        dataType: "json",
                        success: function (data) {
                            console.log(data);
                            edit.item = {id: item.id, name: item.name, value: item.value};
                            if (data.msg == 1) {
                                edit.isError = {"d-none": true};
                                edit.isSuccess = {"d-none": false};
                            } else {
                                edit.isError = {"d-none": false};
                                edit.isSuccess = {"d-none": true};
                            }
                        },
                        error: function (e) {
                            console.log(e.status);
                            console.log(e.responseText);
                        }
                    });
                    item.isReadOnly = "readOnly";
                    item.status = "编辑";
                }
            },
            created: function () {
                $.ajax({
                    type: "GET",
                    url: "{{route('admin.blog.config.ajax.index')}}",
                    success: function (data) {

                        console.log(data);

                        data.forEach(item => {
                            item.status = "编辑";
                            item.isReadOnly = "readOnly";
                        });
                        edit.list = data;


                    },
                    error: function (e) {
                        console.log(e.status);
                        console.log(e.responseText);
                    }
                });

                this.table = $("#posts-table").DataTable({
                    order: [[0, "desc"]]
                });

            },
            updated: function () {
                this.table.draw(false);
            }
        });
    </script>
@stop