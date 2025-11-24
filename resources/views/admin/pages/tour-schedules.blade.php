@extends('admin.layouts.app')

@section('page-title', __('common.tour_schedules'))

@section('content')
    <div style="margin-bottom: 20px;">
        <button class="btn btn-primary" onclick="openTourScheduleModal()">
            <i class="fas fa-plus"></i> {{ __('common.add_new_schedule') }}
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success" style="margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-wrapper">
        <div class="table-head">
            <div class="table-title">{{ __('common.tour_schedules') }}</div>
        </div>
        <div style="overflow-x: auto;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width: 60px; text-align: center;">#</th>
                        <th style="min-width: 200px;">{{ __('common.tour') }}</th>
                        <th style="width: 140px; text-align: center;">{{ __('common.departure_date') }}</th>
                        <th style="width: 140px; text-align: center;">{{ __('common.end_date') }}</th>
                        <th style="width: 120px; text-align: right;">{{ __('common.price') }}</th>
                        <th style="width: 100px; text-align: center;">{{ __('common.participants') }}</th>
                        <th style="width: 100px; text-align: center;">{{ __('common.booking') }}</th>
                        <th style="width: 160px; text-align: center;">{{ __('common.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($schedules as $schedule)
                        <tr>
                            <td style="text-align: center;">{{ $schedule->id }}</td>
                            <td>
                                <strong style="display: block; margin-bottom: 4px;">{{ $schedule->tour->name ?? 'N/A' }}</strong>
                                <small style="color: var(--traveloka-muted);">{{ $schedule->tour->location ?? '-' }}</small>
                            </td>
                            <td style="text-align: center;">
                                {{ $schedule->start_date->format('d/m/Y') }}
                            </td>
                            <td style="text-align: center;">
                                {{ $schedule->end_date->format('d/m/Y') }}
                            </td>
                            <td style="text-align: right; font-weight: 600; color: var(--traveloka-orange);">
                                {{ number_format($schedule->price, 0, '.', ',') }} {{ __('common.vnd') }}
                            </td>
                            <td style="text-align: center;">
                                {{ $schedule->max_participants }} {{ __('common.people') }}
                            </td>
                            <td style="text-align: center;">
                                <span class="status-badge status-{{ $schedule->bookings_count > 0 ? 'success' : 'pending' }}">
                                    {{ $schedule->bookings_count }}
                                </span>
                            </td>
                            <td>
                                <div style="display: flex; gap: 8px; justify-content: center; align-items: center;">
                                    <button class="btn btn-warning btn-sm btn-action" 
                                            onclick="editTourSchedule(@json($schedule->id), @json($schedule->tour_id), @json($schedule->start_date->format('Y-m-d')), @json($schedule->end_date->format('Y-m-d')), @json($schedule->price), @json($schedule->max_participants))"
                                            title="{{ __('common.edit_schedule') }}">
                                        <i class="fas fa-edit"></i>
                                        <span>{{ __('common.edit') }}</span>
                                    </button>
                                    <button class="btn btn-danger btn-sm btn-action" 
                                            onclick="deleteTourSchedule({{ $schedule->id }})"
                                            title="{{ __('common.delete') }}">
                                        <i class="fas fa-trash"></i>
                                        <span>{{ __('common.delete') }}</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="empty-state">{{ __('common.no_schedules_found') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination">
            {{ $schedules->links() }}
        </div>
    </div>

    @include('admin.components.tour-schedule-modals')
@endsection

@push('scripts')
<script>
    // Open Tour Schedule Modal
    function openTourScheduleModal() {
        const modal = document.getElementById('tourScheduleModal');
        if (modal) {
            modal.style.display = 'block';
            const form = document.getElementById('tourScheduleForm');
            if (form) {
                form.reset();
            }
        } else {
            console.error('Tour schedule modal not found');
        }
    }

    // Edit Tour Schedule
    function editTourSchedule(id, tourId, startDate, endDate, price, maxParticipants) {
        const modal = document.getElementById('editTourScheduleModal');
        if (modal) {
            modal.style.display = 'block';
            document.getElementById('edit_schedule_id').value = id;
            document.getElementById('edit_schedule_tour_id').value = tourId;
            document.getElementById('edit_schedule_start_date').value = startDate;
            document.getElementById('edit_schedule_end_date').value = endDate;
            document.getElementById('edit_schedule_price').value = price;
            document.getElementById('edit_schedule_max_participants').value = maxParticipants;
            document.getElementById('editTourScheduleForm').action = `/admin/tour-schedules/${id}`;
        }
    }

    // Delete Tour Schedule
    function deleteTourSchedule(id) {
        if (confirm('{{ __('common.confirm_delete_schedule') }}')) {
            fetch(`/admin/tour-schedules/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(async response => {
                if (response.ok) {
                    window.location.reload();
                } else {
                    const data = await response.json();
                    alert(data.message || '{{ __('common.cannot_delete_schedule_with_bookings') }}');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('{{ __('common.cannot_delete_schedule_with_bookings') }}');
            });
        }
    }

    // Close modals when clicking outside
    document.addEventListener('click', function(event) {
        const scheduleModal = document.getElementById('tourScheduleModal');
        const editScheduleModal = document.getElementById('editTourScheduleModal');
        if (scheduleModal && event.target == scheduleModal) {
            scheduleModal.style.display = 'none';
        }
        if (editScheduleModal && event.target == editScheduleModal) {
            editScheduleModal.style.display = 'none';
        }
    });
</script>
@endpush

