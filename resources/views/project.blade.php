@extends('layouts.app')

@section('content')

    <div class="m-content">

        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="#" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air" data-toggle="modal" data-target="#project">
                                <span>
                                    <i class="la la-plus"></i>
                                    <span>Новый проект</span>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="m-portlet__body">

                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Название проекта</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    @foreach($projects as $project)
                        @if($project->user_id == Auth::user()->id)
                            <tbody>
                            <tr>
                                @if(isset($project->id))
                                    <td>{{$project->id}}</td>
                                <td>
                                    <a href="{{action('ProjectController@editProject', $project->id)}}">{{$project->name}}</a>
                                </td>

                                <td nowrap="">

                                    <a href="{{action('ProjectController@editProject', $project->id)}}"
                                       type="button" class="btn btn-info"
                                       data-toggle="modal" data-target="#edit{{$project->id}}" style="float: left;"> update
                                    </a>

                                    {{--Модальное окно обновления проекта--}}

                                    <div class="modal fade show" id="edit{{$project->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none; padding-right: 17px;">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Update: </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <form method="post" action="{{action('ProjectController@updateProject', $project->id)}}" class="upd-category-form">
                                                    {{csrf_field()}}
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="name" class="form-control-label">Название:</label>
                                                            <input type="text" class="name form-control" name="name" value="{{$project->name}}">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                                                        <button type="submit" class="category-upd btn btn-primary">
                                                            Обновить</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <form action="{{action('ProjectController@deleteProject', $project->id)}}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">delete</button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                            </tbody>
                        @endif
                    @endforeach
                </table>
            </div>
        </div>

        <!-- END EXAMPLE TABLE PORTLET-->
    </div>

@stop