@extends('layouts.app')

@section('content')

<table>
    <thead>
    <tr>
        {{--<th>Id</th>--}}
        <th>Название задачи</th>
        <th>Задача</th>
        <th>Название проекта</th>
        <th>Статус</th>
        <th>Пользователь</th>
        <th>Файл</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>{{$task->name}}</td>
        <td><textarea disabled="" name="" id="" cols="30" rows="10">{{$task->task}}</textarea></td>
        <td>{{$task->project->name}}</td>
        <td>{{$task->taskstatus->status}}</td>
        <td>{{$task->user->name}}</td>
        <td>
            @if(isset($task->img_path))
                <a href="{{'/img/taskfiles/' . $task['img_path']}}" target="_blank" >Скачать</a>
            @endif
        </td>
    </tr>
    </tbody>
</table>







@stop