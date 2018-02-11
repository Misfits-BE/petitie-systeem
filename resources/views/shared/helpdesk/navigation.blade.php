<div class="panel panel-default panel-body">
    <ul class="nav nav-pills">
        <li role="presentation" class="{{ isActive('admin/helpdesk') }}">
            <a href="{{ route('admin.helpdesk.index') }}">Dashboard</a>
        </li>
        <li role="presentation">
            <a href="">Assigned tickets <span class="badge">{{ $assignedTickets }}</span></a>
        </li>
        <li role="presentation">
            <a href="">Open tickets <span class="badge">{{ $openTickets}}</span></a>
        </li>
        <li role="presentation" class="{{ isActive('admin/helpdesk/categories*') }}">
            <a href="{{ route('admin.helpdesk.categories.index') }}">Categories</a>
        </li>
    </ul>
</div>