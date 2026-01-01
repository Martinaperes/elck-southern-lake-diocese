{{-- resources/views/admin/newsletter/components/subscriber-row.blade.php --}}
@props(['subscriber', 'showCheckbox' => true])

<tr data-subscriber-id="{{ $subscriber->id }}" class="hover:bg-gray-50 dark:hover:bg-gray-800">
    @if($showCheckbox)
    <td class="px-6 py-4 whitespace-nowrap">
        <input type="checkbox" 
               name="subscribers[]" 
               value="{{ $subscriber->id }}" 
               class="subscriber-checkbox rounded border-gray-300 text-primary focus:ring-primary"
               @if(isset($selected) && in_array($subscriber->id, $selected)) checked @endif>
    </td>
    @endif
    
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="flex items-center">
            <div class="flex-shrink-0 h-10 w-10 bg-primary/10 rounded-full flex items-center justify-center">
                <span class="material-symbols-outlined text-primary text-lg">person</span>
            </div>
            <div class="ml-4">
                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                    {{ $subscriber->email }}
                </div>
                @if($subscriber->name)
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    {{ $subscriber->name }}
                </div>
                @endif
            </div>
        </div>
    </td>
    
    <td class="px-6 py-4 whitespace-nowrap">
        @if($subscriber->parish)
            @php
                $parishLabels = [
                    'cathedral' => ['label' => 'St. John\'s Cathedral', 'color' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300'],
                    'imani' => ['label' => 'Imani Parish', 'color' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300'],
                    'baraka' => ['label' => 'Baraka Parish', 'color' => 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300'],
                    'visitor' => ['label' => 'Visitor', 'color' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300'],
                ];
                $parishInfo = $parishLabels[$subscriber->parish] ?? ['label' => ucfirst($subscriber->parish), 'color' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300'];
            @endphp
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $parishInfo['color'] }}">
                {{ $parishInfo['label'] }}
            </span>
        @else
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                Not specified
            </span>
        @endif
    </td>
    
    <td class="px-6 py-4 whitespace-nowrap">
        @if($subscriber->is_active)
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                <span class="w-2 h-2 rounded-full bg-green-500 mr-1.5"></span>
                Active
            </span>
        @else
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300">
                <span class="w-2 h-2 rounded-full bg-red-500 mr-1.5"></span>
                Inactive
            </span>
        @endif
    </td>
    
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
        <div class="flex flex-col">
            <span class="font-medium">{{ $subscriber->subscribed_at->format('M j, Y') }}</span>
            <span class="text-xs">{{ $subscriber->subscribed_at->diffForHumans() }}</span>
        </div>
    </td>
    
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
        @if($subscriber->unsubscribed_at)
            <div class="flex flex-col">
                <span class="font-medium">{{ $subscriber->unsubscribed_at->format('M j, Y') }}</span>
                <span class="text-xs">{{ $subscriber->unsubscribed_at->diffForHumans() }}</span>
            </div>
        @else
            <span class="text-gray-400 dark:text-gray-600">—</span>
        @endif
    </td>
    
    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
        <div class="flex items-center space-x-2">
            <!-- View Details Button -->
            <button type="button" 
                    class="text-primary hover:text-primary-dark dark:text-primary-400 dark:hover:text-primary-300"
                    @click="showSubscriberDetails({{ $subscriber->id }})"
                    title="View Details">
                <span class="material-symbols-outlined text-lg">visibility</span>
            </button>
            
            <!-- Email Button -->
            <a href="mailto:{{ $subscriber->email }}" 
               class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-300"
               title="Send Email">
                <span class="material-symbols-outlined text-lg">mail</span>
            </a>
            
            <!-- Status Toggle Button -->
            @if($subscriber->is_active)
                <form action="{{ route('admin.newsletter.unsubscribe', $subscriber) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" 
                            class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                            onclick="return confirm('Unsubscribe {{ $subscriber->email }}?')"
                            title="Unsubscribe">
                        <span class="material-symbols-outlined text-lg">unsubscribe</span>
                    </button>
                </form>
            @else
                <form action="{{ route('admin.newsletter.resubscribe', $subscriber) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" 
                            class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300"
                            title="Resubscribe">
                        <span class="material-symbols-outlined text-lg">replay</span>
                    </button>
                </form>
            @endif
            
            <!-- Delete Button -->
            <form action="{{ route('admin.newsletter.subscribers.destroy', $subscriber) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="text-gray-600 hover:text-red-600 dark:text-gray-400 dark:hover:text-red-400"
                        onclick="return confirm('Permanently delete {{ $subscriber->email }}?')"
                        title="Delete">
                    <span class="material-symbols-outlined text-lg">delete</span>
                </button>
            </form>
        </div>
    </td>
</tr>

<!-- Details Modal (Triggered by Alpine.js) -->
<div x-show="subscriberDetailsId === {{ $subscriber->id }}" 
     x-cloak
     class="fixed inset-0 z-50 overflow-y-auto" 
     x-ref="modal{{ $subscriber->id }}"
     @click.away="subscriberDetailsId = null">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" 
             x-show="subscriberDetailsId === {{ $subscriber->id }}"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"></div>
        
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        
        <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6"
             x-show="subscriberDetailsId === {{ $subscriber->id }}"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <div class="sm:flex sm:items-start">
                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-primary/10 sm:mx-0 sm:h-10 sm:w-10">
                    <span class="material-symbols-outlined text-primary">person</span>
                </div>
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">
                        Subscriber Details
                    </h3>
                    <div class="mt-4 space-y-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Email Address</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-300">
                                {{ $subscriber->email }}
                                <a href="mailto:{{ $subscriber->email }}" class="ml-2 text-primary hover:underline">(Send Email)</a>
                            </dd>
                        </div>
                        
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Full Name</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-300">
                                {{ $subscriber->name ?? 'Not provided' }}
                            </dd>
                        </div>
                        
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Parish</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-300">
                                @if($subscriber->parish)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $parishInfo['color'] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                                        {{ $parishInfo['label'] ?? ucfirst($subscriber->parish) }}
                                    </span>
                                @else
                                    Not specified
                                @endif
                            </dd>
                        </div>
                        
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Subscription Status</dt>
                            <dd class="mt-1">
                                @if($subscriber->is_active)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                        Active Subscriber
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300">
                                        Unsubscribed
                                    </span>
                                @endif
                            </dd>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Subscribed</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-300">
                                    {{ $subscriber->subscribed_at->format('F j, Y, g:i A') }}
                                </dd>
                            </div>
                            
                            @if($subscriber->unsubscribed_at)
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Unsubscribed</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-300">
                                    {{ $subscriber->unsubscribed_at->format('F j, Y, g:i A') }}
                                </dd>
                            </div>
                            @endif
                        </div>
                        
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Subscription Token</dt>
                            <dd class="mt-1">
                                <code class="text-xs bg-gray-100 dark:bg-gray-700 p-2 rounded break-all">
                                    {{ $subscriber->subscription_token }}
                                </code>
                                <button type="button" 
                                        class="ml-2 text-xs text-primary hover:underline"
                                        @click="copyToClipboard('{{ $subscriber->subscription_token }}')">
                                    Copy
                                </button>
                            </dd>
                        </div>
                        
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Unsubscribe Link</dt>
                            <dd class="mt-1">
                                <code class="text-xs bg-gray-100 dark:bg-gray-700 p-2 rounded break-all">
                                    {{ route('newsletter.unsubscribe', $subscriber->subscription_token) }}
                                </code>
                                <button type="button" 
                                        class="ml-2 text-xs text-primary hover:underline"
                                        @click="copyToClipboard('{{ route('newsletter.unsubscribe', $subscriber->subscription_token) }}')">
                                    Copy
                                </button>
                            </dd>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                <button type="button" 
                        @click="subscriberDetailsId = null"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary text-base font-medium text-white hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:ml-3 sm:w-auto sm:text-sm">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>