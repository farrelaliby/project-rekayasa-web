@extends('layouts.app')

@section('title', 'Detail Project')

@section('content')

<div class="container py-5">

    {{-- Tombol kembali --}}
    <div class="mb-4">
        <a href="{{ route('project.index') }}"
           class="btn btn-outline-secondary">
            &larr; Kembali ke Daftar Project
        </a>
    </div>

    {{-- Detail Project --}}
    <div class="project-detail-card">

        {{-- Header --}}
        <div class="project-detail-header">
            <span class="badge
                {{ $project->status == 'Selesai'
                    ? 'bg-success'
                    : 'bg-warning text-dark' }}">
                {{ $project->status }}
            </span>

            <h2 class="project-title mt-3">
                {{ $project->title ?? 'Tanpa Judul' }}
            </h2>

            <p class="project-subtitle">
                Detail informasi project
            </p>
        </div>

        {{-- Gambar Project --}}
        @if ($project->image)
            <div class="project-detail-image-wrapper">
                <img
                    src="{{ asset('gambar/' . $project->image) }}"
                    alt="Gambar {{ $project->title }}"
                    class="project-detail-image"
                >
            </div>
        @endif

        {{-- Informasi Project --}}
        <div class="project-detail-body">

            <div class="row g-4">

                {{-- Deskripsi --}}
                <div class="col-12">

                    <div class="detail-info-box">
                        <h5 class="detail-label">
                            Deskripsi Project
                        </h5>

                        <p class="detail-value">
                            {{ $project->description ?? 'Belum ada deskripsi project.' }}
                        </p>
                    </div>

                </div>

                {{-- Teknologi --}}
                <div class="col-md-6">

                    <div class="detail-info-box">
                        <h5 class="detail-label">
                            Teknologi yang Digunakan
                        </h5>

                        <p class="detail-value">
                            {{ $project->teknologi ?? 'Belum ditentukan' }}
                        </p>
                    </div>

                </div>

                {{-- Status --}}
                <div class="col-md-6">

                    <div class="detail-info-box">
                        <h5 class="detail-label">
                            Status Project
                        </h5>

                        <p class="detail-value">
                            {{ $project->status }}
                        </p>
                    </div>

                </div>

                {{-- Tanggal dibuat --}}
                <div class="col-md-6">

                    <div class="detail-info-box">
                        <h5 class="detail-label">
                            Tanggal Dibuat
                        </h5>

                        <p class="detail-value">
                            {{ $project->created_at
                                ? $project->created_at->format('d F Y')
                                : '-' }}
                        </p>
                    </div>

                </div>

                {{-- Terakhir diperbarui --}}
                <div class="col-md-6">

                    <div class="detail-info-box">
                        <h5 class="detail-label">
                            Terakhir Diperbarui
                        </h5>

                        <p class="detail-value">
                            {{ $project->updated_at
                                ? $project->updated_at->format('d F Y')
                                : '-' }}
                        </p>
                    </div>

                </div>

            </div>

            {{-- Tombol bawah --}}
            <div class="mt-4">
                <a href="{{ route('project.index') }}"
                   class="btn btn-primary">
                    Kembali ke Daftar Project
                </a>
            </div>

        </div>

    </div>

</div>

{{-- CSS halaman detail --}}
<style>
    .project-detail-card {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    .project-detail-header {
        padding: 30px;
        border-bottom: 1px solid #eee;
    }

    .project-title {
        font-size: 30px;
        font-weight: 700;
        color: #212529;
    }

    .project-subtitle {
        color: #6c757d;
        margin-bottom: 0;
    }

    .project-detail-image-wrapper {
        padding: 25px 30px 0;
    }

    .project-detail-image {
        width: 100%;
        max-height: 450px;
        object-fit: contain;
        background: #f8f9fa;
        border-radius: 12px;
    }

    .project-detail-body {
        padding: 30px;
    }

    .detail-info-box {
        height: 100%;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 10px;
        border: 1px solid #eee;
    }

    .detail-label {
        font-size: 15px;
        font-weight: 600;
        color: #6c757d;
        margin-bottom: 12px;
    }

    .detail-value {
        font-size: 16px;
        line-height: 1.8;
        color: #212529;
        margin-bottom: 0;
        overflow-wrap: anywhere;
        white-space: pre-line;
    }

    @media (max-width: 576px) {
        .project-detail-header,
        .project-detail-body {
            padding: 20px;
        }

        .project-detail-image-wrapper {
            padding: 20px 20px 0;
        }

        .project-title {
            font-size: 24px;
        }
    }
</style>

@endsection