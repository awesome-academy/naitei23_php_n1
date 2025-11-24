<!-- User Modal -->
<div id="userModal" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h3>{{ __('common.add_new_user') }}</h3>
            <span class="close" onclick="document.getElementById('userModal').style.display='none'">&times;</span>
        </div>
        <form id="userForm" action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>{{ __('common.name') }} <span style="color: red;">*</span></label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>{{ __('common.email') }} <span style="color: red;">*</span></label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label>{{ __('common.password') }} <span style="color: red;">*</span></label>
                <input type="password" name="password" class="form-control" required minlength="8" autocomplete="new-password">
                <small style="color: var(--traveloka-muted);">{{ __('common.password_min_8_chars') }}</small>
            </div>
            <div class="form-group">
                <label>{{ __('common.roles') }} <span style="color: red;">*</span></label>
                <div style="display: flex; flex-direction: column; gap: 8px; margin-top: 8px;">
                    @foreach($roles ?? [] as $role)
                        <label style="display: flex; align-items: center; gap: 8px; font-weight: normal; cursor: pointer;">
                            <input type="checkbox" name="role_ids[]" id="role_{{ $role->id }}" value="{{ $role->id }}" class="form-control" style="width: auto;">
                            <span>{{ $role->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
            <div style="text-align: right; margin-top: 20px; padding: 0 20px 20px;">
                <button type="button" class="btn btn-secondary" onclick="document.getElementById('userModal').style.display='none'">{{ __('common.cancel') }}</button>
                <button type="submit" class="btn btn-primary">{{ __('common.add') }}</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit User Modal -->
<div id="editUserModal" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h3>{{ __('common.edit_user') }}</h3>
            <span class="close" onclick="document.getElementById('editUserModal').style.display='none'">&times;</span>
        </div>
        <form id="editUserForm" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="user_id" id="edit_user_id">
            <div class="form-group">
                <label>{{ __('common.name') }} <span style="color: red;">*</span></label>
                <input type="text" name="name" id="edit_user_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>{{ __('common.email') }} <span style="color: red;">*</span></label>
                <input type="email" name="email" id="edit_user_email" class="form-control" required>
            </div>
            <div class="form-group">
                <label>{{ __('common.password') }}</label>
                <input type="password" name="password" class="form-control" minlength="8" autocomplete="new-password">
                <small style="color: var(--traveloka-muted);">{{ __('common.password_leave_empty_to_keep_current') }}</small>
            </div>
            <div class="form-group">
                <label>{{ __('common.roles') }} <span style="color: red;">*</span></label>
                <div style="display: flex; flex-direction: column; gap: 8px; margin-top: 8px;">
                    @foreach($roles ?? [] as $role)
                        <label style="display: flex; align-items: center; gap: 8px; font-weight: normal; cursor: pointer;">
                            <input type="checkbox" name="role_ids[]" id="edit_role_{{ $role->id }}" value="{{ $role->id }}" class="form-control" style="width: auto;">
                            <span>{{ $role->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
            <div style="text-align: right; margin-top: 20px; padding: 0 20px 20px;">
                <button type="button" class="btn btn-secondary" onclick="document.getElementById('editUserModal').style.display='none'">{{ __('common.cancel') }}</button>
                <button type="submit" class="btn btn-primary">{{ __('common.update') }}</button>
            </div>
        </form>
    </div>
</div>

