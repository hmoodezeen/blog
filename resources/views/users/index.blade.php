@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            All Users
            </div>
            @if ($users->count() > 0)
            <table class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>username</th>
                            <th>permissions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>
                                <img src="{{ $user->hasPicture() ? asset('storage/'.$user->getPicture()) : $user->getGravatar() }}" style="border-radius: 50%" width="60px" height="60px" >
                            </td>
                            <td>
                                {{ $user->name }}
                            </td>
                            <td>
                                @if (!$user->isAdmin())
                                <div class="ml-4">
                                    {{ $user->role }}
                                </div>
                                    <form action="{{ route('users.make-admin', $user->id)}}" method="POST">
                                        @csrf
                                    <button class="btn btn-success" type="submit">Make admin</button>
                                    </form>
                                @else
                                <div class="ml-4">
                                    {{ $user->role }}
                                </div>
                                <form action="{{ route('users.make-writer', $user->id)}}" method="POST">
                                    @csrf
                                <button class="btn btn-success" type="submit">Make writer</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </table>                
            @else
                <div class="card-body">
                    <h1 class="text-center">
                    No users yet.
                    </h1>
                </div>
            @endif
    </div>
@endsection
