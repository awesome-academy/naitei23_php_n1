@extends('admin.layouts.app')

@section('page-title', 'Danh mục tour')

@section('content')
    <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 20px;">
        @forelse ($categories as $category)
            <div class="tile">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <p style="font-size: 1.1rem; font-weight: 600;">{{ $category->name }}</p>
                        <p style="color: var(--traveloka-muted); margin: 0;">
                            {{ $category->slug }}
                        </p>
                    </div>
                    <span class="chip">{{ $category->tours_count }} tour</span>
                </div>
                <p style="margin-top: 14px; color: var(--traveloka-text);">
                    {{ $category->description ?? 'Chưa có mô tả' }}
                </p>
            </div>
        @empty
            <div class="tile empty-state">
                Chưa có danh mục nào
            </div>
        @endforelse
    </div>
@endsection

