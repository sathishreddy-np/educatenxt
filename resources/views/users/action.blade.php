<div style="display: flex; gap: 10px;">
    <a href="{{ route('users.edit', $row->id) }}" class="btn btn-primary btn-sm">
        <i class="fas fa-edit"></i>
    </a>

    <form action="{{ route('users.destroy', $row->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">
            <i class="fas fa-trash-alt"></i>
        </button>
    </form>
</div>
