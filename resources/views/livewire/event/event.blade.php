<div>
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Agenda</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Agenda</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 ">
                <div class="card">
                    <div class="card-header bg-info" style="color:white">
                    </div>
                    <div class="card-body">
                        <div class="input-group mb-3">
                            <input type="text" wire:model="search" class="form-control"
                                placeholder="Cari dengan kata kunci berdasarkan judul.."
                                aria-label="Recipient's username" aria-describedby="button-addon2">
                        </div>
                    </div>
                </div>
            </div>

            @if ($event->count() > 0)
                <div class="row">
                    @foreach ($event as $row)
                        <div class="col-md-6 col-xl-4 col-sm-12 d-flex">
                            <div class="blog grid-blog flex-fill">
                                <div class="blog-image">
                                    <a href="{{ route('event') }}"><img class="img-fluid"
                                            src="{{ asset('storage/' . $row->image) }}" alt="Post Image"></a>
                                    <div class="blog-views">
                                        <i class="feather-eye me-1"></i> {{ $row->views }}
                                    </div>
                                </div>
                                <div class="blog-content">
                                    <ul class="entry-meta meta-item">
                                        <li>
                                            <div class="post-author">
                                                <a>
                                                    <img src="{{ asset('pria.png') }}" alt="Post Author">
                                                    <span>
                                                        <span class="post-title">{{ $row->user->name }}</span>
                                                        <span class="post-date"><i class="far fa-clock"></i>
                                                            {{ $row->created_at->diffForHumans() }}</span>
                                                    </span>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                    <h3 class="blog-title"><a href="{{ route('event') }}">{{ $row->judul }} </a></h3>
                                    <p>
                                        {{ Str::substr($row->ket, 0, 110) }}
                                    </p>
                                </div>
                                <br>
                                @if ($row->status == 'Publish')
                                    <div class="text-center inactive-style">
                                        <a href="javascript:void(0);" class="text-success" data-bs-toggle="modal"
                                            data-bs-target="#deleteNotConfirmModal"><i class="feather-eye me-1"></i>
                                            Publish</a>
                                    </div>
                                @else
                                    <div class="text-center inactive-style">
                                        <a href="javascript:void(0);" class="text-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteNotConfirmModal"><i class="feather-eye-off me-1"></i>
                                            Draft</a>
                                    </div>
                                @endif
                                <br>
                                <center>
                                    <div class="row ">
                                        <div class="edit-options justify-content-center">
                                            <div class="edit-delete-btn">
                                                <a href="{{ route('edit-event', $row->id) }}"
                                                    class="btn btn-warning border-0"><i class="feather-edit-3 me-1"></i>
                                                    Edit</a>
                                                <a wire:click="$emit('triggerDelete',{{ $row->id }})"
                                                    class="btn btn-warning border-0"><i
                                                        class="feather-trash-2 me-1"></i>
                                                    Delete</a>
                                                <a href="{{ route('detail-event', $row->id) }}"
                                                    class="btn btn-warning border-0"><i class="feather-eye me-1"></i>
                                                    Detail</a>

                                            </div>

                                        </div>
                                    </div>

                                </center>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-danger" role="alert">
                    <strong>No Agenda found</strong>
                </div>
            @endif
            <br>
            <br>
            <div class="d-flex justify-content-center">
                {{ $event->links() }}

            </div>

            <br>
            <br>

        </div>

    </div>
    @if (session()->has('hapus'))
        <script>
            toastr.success(
                "{{ session('hapus') }}",
                "Informasi!", {
                    positionClass: "toast-top-right"
                }
            );
        </script>
    @endif

    @push('scripts')
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                @this.on('triggerDelete', id => {
                    Swal.fire({
                        title: 'Hapus data ini?',
                        text: "Data yang sudah dihapus tidak dapat kembali!",
                        icon: 'warning',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        showCancelButton: true,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            @this.call('delete', id)

                        }

                    });
                });
            })
        </script>
    @endpush
