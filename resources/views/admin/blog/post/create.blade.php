@extends('admin.blog.layouts.dashboard')
@section('styles')
    <link href="{{ asset('css/pickadate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/selectize.default.css') }}" rel="stylesheet">
    <style>
        [v-cloak]{
            display:none;
        }
    </style>
@stop

@section('content')
    <div class="container" id="app" v-cloak>
        <div class="row page-title-row">
            <div class="col-md-12">
                <h3>文章
                    <small>» 创建新文章</small>
                </h3>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">创建新文章表单</h3>
                    </div>
                    <div class="card-body">

                        <requiresuccess v-if="status == 'success'"></requiresuccess>
                        <requireerror v-if="status == 'error' "></requireerror>

                        <form role="form" method="POST" action="{{ route('admin.blog.post.store') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            @include('admin.blog.post._form')

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group row">
                                        <div class="col-md-10 offset-md-2">
                                            <button v-on:click="submit" type="button" class="btn btn-primary">
                                                <i class="fa fa-disk-o"></i>
                                                保存新文章
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('scripts')
    <script src="{{ asset('js/pickadate.min.js') }}"></script>
    <script src="{{ asset('js/selectize.min.js') }}"></script>
    <script>
        $(function () {
            $("#publish_date").pickadate({
                format: "yyyy-mm-dd"
            });
            $("#publish_time").pickatime({
                format: "h:i A"
            });
            $("#tags").selectize({
                create: true
            });
        });
    </script>
    <script>
        const app = new Vue({
            el: "#app",
            data: {
                list: {
                    tags: [],
                    publish_time: "{{ $publish_time }}",
                    publish_date: "{{ $publish_date }}",
                },
                tags: {},
                action: "",
                status:"",

            },
            methods: {
                submit: function () {
                    console.log(this.list);
                    axios.post('{{route('admin.blog.post.store')}}', app.list)
                        .then(function (res) {
                            console.log(res.data);
                            if(res.data.code == 200){
                                app.status = "success";
                            }else{
                                app.status = "failed";
                            }
                        }).catch(function (error) {
                        console.log(error);
                    });
                },
            },
            created: function () {
                axios.get("{{route('admin.blog.tag.ajax.index')}}").then(function (res) {
                    app.tags = res.data;
                });
            },
        });
    </script>
@stop