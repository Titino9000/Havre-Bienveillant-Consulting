<div>
    @if($viewingItem)
        <div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title fw-bold"><i class="bx bx-detail me-2"></i>{{ $viewItemTitle }}</h5>
                        <button type="button" class="btn-close" wire:click="closeViewModal"></button>
                    </div>
                    <div class="modal-body p-4">
                        @if(empty($viewItemData))
                            <p class="text-muted mb-0">No details available.</p>
                        @else
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <tbody>
                                        @foreach($viewItemData as $key => $value)
                                            <tr>
                                                <th class="w-25 bg-light align-middle text-nowrap">{{ ucwords(str_replace('_', ' ', $key)) }}</th>
                                                <td class="align-middle text-break">
                                                    @if(is_array($value) || is_object($value))
                                                        <pre class="mb-0" style="white-space: pre-wrap;">{{ json_encode($value, JSON_PRETTY_PRINT) }}</pre>
                                                    @elseif(is_bool($value))
                                                        <span class="badge {{ $value ? 'bg-label-success' : 'bg-label-danger' }}">{{ $value ? 'Yes' : 'No' }}</span>
                                                    @elseif(empty($value) && $value !== 0 && $value !== '0')
                                                        <span class="text-muted fst-italic">N/A</span>
                                                    @elseif(preg_match('/<[^>]*>/', (string)$value))
                                                        {!! $value !!}
                                                    @else
                                                        {!! nl2br(e($value)) !!}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" wire:click="closeViewModal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
