@extends('layouts.app')

@section('content')

    <div class="m-content">

    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">

                    <li class="m-portlet__nav-item">
                        <a href="{{action('IndexController@project')}}" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air">
												<span>
													<i class="la la-plus"></i>
													<span>На главную</span>
												</span>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air" data-toggle="modal" data-target="#add_new_user">
												<span>
													<i class="la la-plus"></i>
													<span>Добавить пользователя в проект</span>
												</span>
                        </a>
                    </li>

                    <li class="m-portlet__nav-item">
                        <a href="" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air" data-toggle="modal" data-target="#task{{$project->id}}">
												<span>
													<i class="la la-plus"></i>
													<span>Добавить задачу</span>
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
                    <th>Название</th>
                    <th>Задача</th>
                    <th>Статус</th>
                    <th>Файл</th>
                    <th>Actions</th>
                </tr>
                </thead>
                @foreach($tasks as $task)
                    <tbody>
                    <tr>
                        <td><a href="{{action('IndexController@detail', [$project->id, $task->id])}}">{{$task->name}}</a></td>
                        <td>{{$task->task}}</td>
                        <td>
                            {{$task->taskStatus->status}}
                            {{--<select class="form-control" size="1" name="task_statu_id" required>--}}
                                {{--<option disabled selected value="{{$task->taskStatus->id}}">{{$task->taskStatus->status}}</option>--}}
                                {{--@foreach($taskStatus as $status)--}}
                                    {{--<option value="{{$status->id}}">{{$status->status}}</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        </td>
                        <td>
                            @if(isset($task->img_path))
                                <a href="{{'/img/taskfiles/' . $task['img_path']}}" target="_blank" download="">Скачать</a>
                            @endif
                        </td>

                        <td nowrap="">

                            <a href=""
                               type="button" class="btn btn-primary"
                               data-toggle="modal" data-target="#edit{{$task->id}}" style="float: left;">update
                            </a>


                            {{--Модальное окно обновления задачи--}}

                            <div class="modal fade show" id="edit{{$task->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none; padding-right: 17px;">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Update: </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>

                                        {{--<div class="alert alert-info">--}}
                                        {{--<p>Данные обновлены</p>--}}
                                        {{--</div>--}}

                                        <form method="post" action="{{action('TaskController@updateTask', $task->id)}}" class="upd-category-form" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <div class="form-group">
                                                <label for="name" class="form-control-label">Название:</label>
                                                <input type="text" class="form-control" name="name" value="{{$task->name}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="task" class="form-control-label">Задача:</label>
                                                <textarea class="form-control" name="task" id="" cols="20" rows="5">{{$task->task}}</textarea>
                                            </div>
                                                <label for="task_status_id" class="form-control-label">Статус:</label>
                                                <select class="form-control" size="1" name="task_status_id" required>
                                                    <option hidden selected value="{{$task->taskStatus->id}}">{{$task->taskStatus->status}}</option>
                                                    @foreach($taskStatus as $status)
                                                        <option  value="{{$status->id}}">{{$status->status}}</option>
                                                    @endforeach
                                                </select>
                                            <div class="form-group">
                                                <label for="img_path" class="form-control-label">Файл:</label>
                                                <input type="file" class="form-control" name="img_path">
                                            </div>
                                            <div class="form-group">
                                                {{--<label for="project_id" class="form-control-label">Проект:</label>--}}
                                                <input hidden type="text" class="form-control" name="project_id" value="{{$project->id}}">
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

                            <form action="{{action('TaskController@deleteTask', $task->id)}}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-danger">delete</button>
                            </form>

                        </td>
                    </tr>
                    </tbody>

                @endforeach
            </table>
        </div>
    </div>

    <!-- END EXAMPLE TABLE PORTLET-->
    </div>

    {{--Новая задача к проекту--}}

    <div class="modal fade show" id="task{{$project->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none; padding-right: 17px;">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Новая задача</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="m-scrollable m-scroller ps ps--active-y" data-scrollbar-shown="true" data-scrollable="true" data-height="400" style="height: 400px; overflow: hidden;">
                        <form method="post" action="{{action('TaskController@addTask')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="form-control-label">Название:</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="form-group">
                                <label for="task" class="form-control-label">Задача:</label>
                                <textarea class="form-control" name="task" id="" cols="20" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="img_path" class="form-control-label">Файл:</label>
                                <input type="file" class="form-control" name="img_path">
                            </div>
                            <div class="form-group">
                                {{--<label for="project_id" class="form-control-label">Проект:</label>--}}
                                <input hidden type="text" class="form-control" name="project_id" value="{{$project->id}}">
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                                <button type="submit" class="btn btn-primary">Добавить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--end--}}

    {{--Modal view for add new user in project--}}

    <div class="modal fade show" id="add_new_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none; padding-right: 17px;">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Новый проект</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="m-scrollable m-scroller ps ps--active-y" data-scrollbar-shown="true" data-scrollable="true" data-height="400" style="height: 400px; overflow: hidden;">
                        <form method="post" action="{{action('ProjectController@addUserInProject', $project->id)}}">
                            @csrf
                            <div class="form-group">
                                <input hidden type="project_id" class="form-control" name="project_id" value="{{$project->id}}">
                            </div>
                            <label for="user_id" class="form-control-label">Выбрать пользователя:</label>
                            <select class="form-control" size="1" name="user_id" required>
                                <option selected value="">Выбрать</option>
                                @foreach($users as $user)
                                    <option  value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                                <button type="submit" class="btn btn-primary">Добавить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--end modal--}}

@stop