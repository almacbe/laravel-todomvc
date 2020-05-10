<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Template • TodoMVC</title>
{{--    <link rel="stylesheet" href="node_modules/todomvc-common/base.css">--}}
{{--    <link rel="stylesheet" href="node_modules/todomvc-app-css/index.css">--}}
    <!-- CSS overrides - remove if you don't need it -->
    <link rel="stylesheet" href="css/app.css">
</head>
<body>
<section class="todoapp">
    <header class="header">
        <h1>todos</h1>
        <form action="{{ route('tasks.store') }}" method="POST" name="add_task">
            {{ csrf_field() }}
            <input name="description" class="new-todo" placeholder="What needs to be done?" autofocus>
        </form>
    </header>
    <!-- This section should be hidden by default and shown when there are todos -->
    @if(count($tasks) > 0)
    <section class="main">
        <input id="toggle-all" class="toggle-all" type="checkbox">
        <label for="toggle-all">Mark all as complete</label>
        <ul class="todo-list">
            <!-- These are here just to show the structure of the list items -->
            <!-- List items should get the class `editing` when editing and `completed` when marked as completed -->
            <li class="completed">
                <div class="view">
                    <input class="toggle" type="checkbox" checked>
                    <label>Taste JavaScript</label>
                    <button class="destroy"></button>
                </div>
                <input class="edit" value="Create a TodoMVC template">
            </li>
            <li>
                <div class="view">
                    <input class="toggle" type="checkbox">
                    <label>Buy a unicorn</label>
                    <button class="destroy"></button>
                </div>
                <input class="edit" value="Rule the web">
            </li>
            @foreach($tasks as $task)
                <li>
                    <div class="view">
                        <input class="toggle" type="checkbox" @if($task->done) checked @endif>
                        <label>{{ $task['description'] }}</label>
                        <form action="{{ route('tasks.destroy', $task->uuid)}}" method="post">
                            {{ csrf_field() }}
                            @method('DELETE')
                            <button class="destroy"></button>
                        </form>
                    </div>
                    <input class="edit" value="Rule the web">
                </li>
            @endforeach
        </ul>
    </section>

    <!-- This footer should hidden by default and shown when there are todos -->
    <footer class="footer">
        <!-- This should be `0 items left` by default -->
        <span class="todo-count"><strong>0</strong> item left</span>
        <!-- Remove this if you don't implement routing -->
        <ul class="filters">
            <li>
                <a class="selected" href="#/">All</a>
            </li>
            <li>
                <a href="#/active">Active</a>
            </li>
            <li>
                <a href="#/completed">Completed</a>
            </li>
        </ul>
        <!-- Hidden if no completed items are left ↓ -->
        <button class="clear-completed">Clear completed</button>
    </footer>
    @endif
</section>
<footer class="info">
    <p>Double-click to edit a todo</p>
    <!-- Remove the below line ↓ -->
    <p>Template by <a href="http://sindresorhus.com">Sindre Sorhus</a></p>
    <!-- Change this out with your name and url ↓ -->
    <p>Created by <a href="http://todomvc.com">you</a></p>
    <p>Part of <a href="http://todomvc.com">TodoMVC</a></p>
</footer>
<!-- Scripts here. Don't remove ↓ -->
{{--<script src="{{ url('node_modules/todomvc-common/base.js') }}"></script>--}}
<script src="js/app.js"></script>
</body>
</html>
