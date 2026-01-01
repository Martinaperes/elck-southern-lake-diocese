{{-- resources/views/admin/newsletter/components/campaign-row.blade.php --}}
@props(['campaign', 'showCheckbox' => false])

<tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
    @if($showCheckbox)
    <td class="px-6 py-4 whitespace-nowrap">
        <input type="checkbox" 
               name="campaigns[]" 
               value="{{ $campaign->id }}" 
               class="campaign-checkbox rounded border-gray-300 text-primary focus:ring-primary">
    </td>
    @endif
    
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="flex items-center">
            <div class="flex-shrink-0 h-10 w-10 {{ $campaign->status === 'sent' ? 'bg-green-100' : ($campaign->status === 'scheduled' ? 'bg-blue-100' : 'bg-gray-100') }} dark:{{ $campaign->status === 'sent' ? 'bg-green-900/30' : ($campaign->status === 'scheduled' ? 'bg-blue-900/30' : 'bg-gray-700') }} rounded-full flex items-center justify-center">
                <span class="material-symbols-outlined {{ $campaign->status === 'sent' ? 'text-green-600' : ($campaign->status === 'scheduled' ? 'text-blue-600' : 'text-gray-600') }} dark:{{ $campaign->status === 'sent' ? 'text-green-400' : ($campaign->status === 'scheduled' ? 'text-blue-400' : 'text-gray-400') }} text-lg">
                    {{ $campaign->status === 'sent' ? 'send' : ($campaign->status === 'scheduled' ? 'schedule' : 'draft') }}
                </span>
            </div>
            <div class="ml-4">
                <div class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate max-w-xs">
                    {{ $campaign->subject }}
                </div>
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    ID: {{ $campaign->id }}
                </div>
            </div>
        </div>
    </td>
    
    <td class="px-6 py-4 whitespace-nowrap">
        @php
            $statusConfig = [
                'draft' => ['label' => 'Draft', 'color' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300', 'icon' => 'draft'],
                'scheduled' => ['label' => 'Scheduled', 'color' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300', 'icon' => 'schedule'],
                'sent' => ['label' => 'Sent', 'color' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300', 'icon' => 'check_circle'],
                'cancelled' => ['label' => 'Cancelled', 'color' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300', 'icon' => 'cancel'],
            ];
            $config = $statusConfig[$campaign->status] ?? $statusConfig['draft'];
        @endphp
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $config['color'] }}">
            <span class="material-symbols-outlined text-xs mr-1">{{ $config['icon'] }}</span>
            {{ $config['label'] }}
        </span>
    </td>
    
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
        <div class="flex flex-col">
            <span class="font-medium">{{ $campaign->created_at->format('M j, Y') }}</span>
            <span class="text-xs">{{ $campaign->created_at->diffForHumans() }}</span>
        </div>
    </td>
    
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
        @if($campaign->scheduled_at)
            <div class="flex flex-col">
                <span class="font-medium">{{ $campaign->scheduled_at->format('M j, Y') }}</span>
                <span class="text-xs">{{ $campaign->scheduled_at->format('g:i A') }}</span>
            </div>
        @else
            <span class="text-gray-400 dark:text-gray-600">—</span>
        @endif
    </td>
    
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
        @if($campaign->sent_at)
            <div class="flex flex-col">
                <span class="font-medium">{{ $campaign->sent_at->format('M j, Y') }}</span>
                <span class="text-xs">{{ $campaign->sent_at->format('g:i A') }}</span>
            </div>
        @else
            <span class="text-gray-400 dark:text-gray-600">—</span>
        @endif
    </td>
    
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
        <div class="flex flex-col">
            <div class="flex items-center space-x-1">
                <span class="font-medium">{{ number_format($campaign->sent_count) }}</span>
                <span class="material-symbols-outlined text-xs text-gray-400">send</span>
            </div>
            <div class="flex items-center space-x-1 mt-1">
                <span class="text-xs">{{ $campaign->opened_count }} opened</span>
                <span class="text-xs text-gray-400">•</span>
                <span class="text-xs">{{ $campaign->clicked_count }} clicked</span>
            </div>
        </div>
    </td>
    
    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
        <div class="flex items-center space-x-2">
            <!-- Preview Button -->
            <button type="button" 
                    class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-300"
                    @click="previewCampaign({{ $campaign->id }})"
                    title="Preview Email">
                <span class="material-symbols-outlined text-lg">preview</span>
            </button>
            
            <!-- Analytics Button -->
            <a href="{{ route('admin.newsletter.analytics', $campaign) }}"
               class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300"
               title="View Analytics">
                <span class="material-symbols-outlined text-lg">analytics</span>
            </a>
            
            <!-- Edit Button (only for draft/scheduled) -->
            @if(in_array($campaign->status, ['draft', 'scheduled']))
                <a href="{{ route('admin.newsletter.edit', $campaign) }}"
                   class="text-primary hover:text-primary-dark dark:text-primary-400 dark:hover:text-primary-300"
                   title="Edit Campaign">
                    <span class="material-symbols-outlined text-lg">edit</span>
                </a>
            @endif
            
            <!-- Send/Resend Button -->
            @if($campaign->status === 'draft' || $campaign->status === 'scheduled')
                <form action="{{ route('admin.newsletter.send', $campaign) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" 
                            class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300"
                            onclick="return confirm('Send this campaign now?')"
                            title="Send Campaign">
                        <span class="material-symbols-outlined text-lg">send</span>
                    </button>
                </form>
            @endif
            
            <!-- Duplicate Button -->
            <form action="{{ route('admin.newsletter.duplicate', $campaign) }}" method="POST" class="inline">
                @csrf
                <button type="submit" 
                        class="text-purple-600 hover:text-purple-900 dark:text-purple-400 dark:hover:text-purple-300"
                        title="Duplicate Campaign">
                    <span class="material-symbols-outlined text-lg">content_copy</span>
                </button>
            </form>
            
            <!-- Cancel/Delete Button -->
            @if($campaign->status === 'scheduled')
                <form action="{{ route('admin.newsletter.cancel', $campaign) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" 
                            class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300"
                            onclick="return confirm('Cancel this scheduled campaign?')"
                            title="Cancel Scheduled Campaign">
                        <span class="material-symbols-outlined text-lg">pause_circle</span>
                    </button>
                </form>
            @endif
            
            @if($campaign->status === 'draft')
                <form action="{{ route('admin.newsletter.destroy', $campaign) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                            onclick="return confirm('Delete this draft campaign?')"
                            title="Delete Draft">
                        <span class="material-symbols-outlined text-lg">delete</span>
                    </button>
                </form>
            @endif
        </div>
    </td>
</tr>

<!-- Campaign Preview Modal -->
<div x-show="previewCampaignId === {{ $campaign->id }}" 
     x-cloak
     class="fixed inset-0 z-50 overflow-y-auto" 
     @click.away="previewCampaignId = null">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" 
             x-show="previewCampaignId === {{ $campaign->id }}"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"></div>
        
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        
        <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full sm:p-6"
             x-show="previewCampaignId === {{ $campaign->id }}"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <div>
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">
                            Campaign Preview
                        </h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            {{ $campaign->subject }}
                        </p>
                    </div>
                    <button type="button" 
                            @click="previewCampaignId = null"
                            class="text-gray-400 hover:text-gray-500">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>
                
                <div class="mt-6">
                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg mb-4">
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <dt class="font-medium text-gray-500 dark:text-gray-400">Status</dt>
                                <dd class="mt-1">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $config['color'] }}">
                                        {{ $config['label'] }}
                                    </span>
                                </dd>
                            </div>
                            <div>
                                <dt class="font-medium text-gray-500 dark:text-gray-400">Created</dt>
                                <dd class="mt-1 text-gray-900 dark:text-gray-300">
                                    {{ $campaign->created_at->format('F j, Y, g:i A') }}
                                </dd>
                            </div>
                            @if($campaign->scheduled_at)
                            <div>
                                <dt class="font-medium text-gray-500 dark:text-gray-400">Scheduled For</dt>
                                <dd class="mt-1 text-gray-900 dark:text-gray-300">
                                    {{ $campaign->scheduled_at->format('F j, Y, g:i A') }}
                                </dd>
                            </div>
                            @endif
                            @if($campaign->sent_at)
                            <div>
                                <dt class="font-medium text-gray-500 dark:text-gray-400">Sent</dt>
                                <dd class="mt-1 text-gray-900 dark:text-gray-300">
                                    {{ $campaign->sent_at->format('F j, Y, g:i A') }}
                                </dd>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
                        <div class="bg-gray-100 dark:bg-gray-800 px-4 py-2 border-b border-gray-200 dark:border-gray-700">
                            <div class="text-sm text-gray-600 dark:text-gray-400">Email Preview</div>
                        </div>
                        <div class="p-4 bg-white dark:bg-gray-900">
                            <!-- Email Content Preview -->
                            <div class="prose dark:prose-invert max-w-none">
                                {!! Str::limit(strip_tags($campaign->content), 500) !!}
                                
                                @if(strlen(strip_tags($campaign->content)) > 500)
                                    <p class="text-gray-500 dark:text-gray-400 italic">
                                        ... (content truncated for preview)
                                    </p>
                                @endif
                            </div>
                            
                            @if(strlen(strip_tags($campaign->content)) > 500)
                                <div class="mt-4 text-center">
                                    <button type="button"
                                            class="text-primary hover:underline text-sm"
                                            @click="showFullContent = !showFullContent">
                                        View Full Content
                                    </button>
                                </div>
                                
                                <div x-show="showFullContent" x-cloak class="mt-4">
                                    <div class="prose dark:prose-invert max-w-none">
                                        {!! $campaign->content !!}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mt-4 grid grid-cols-3 gap-4 text-center">
                        <div class="bg-blue-50 dark:bg-blue-900/20 p-3 rounded-lg">
                            <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">
                                {{ number_format($campaign->sent_count) }}
                            </div>
                            <div class="text-sm text-blue-800 dark:text-blue-300">Sent</div>
                        </div>
                        <div class="bg-green-50 dark:bg-green-900/20 p-3 rounded-lg">
                            <div class="text-2xl font-bold text-green-600 dark:text-green-400">
                                {{ number_format($campaign->opened_count) }}
                            </div>
                            <div class="text-sm text-green-800 dark:text-green-300">Opened</div>
                        </div>
                        <div class="bg-purple-50 dark:bg-purple-900/20 p-3 rounded-lg">
                            <div class="text-2xl font-bold text-purple-600 dark:text-purple-400">
                                {{ number_format($campaign->clicked_count) }}
                            </div>
                            <div class="text-sm text-purple-800 dark:text-purple-300">Clicked</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-5 sm:mt-6 flex justify-end space-x-3">
                <button type="button" 
                        @click="previewCampaignId = null"
                        class="inline-flex justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    Close
                </button>
                <a href="{{ route('admin.newsletter.analytics', $campaign) }}"
                   class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-primary border border-transparent rounded-md hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                    View Full Analytics
                </a>
            </div>
        </div>
    </div>
</div>