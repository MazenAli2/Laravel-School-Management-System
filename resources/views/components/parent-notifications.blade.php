<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
    <div class="p-6">
        <h3 class="text-lg font-semibold mb-4">Notifications</h3>
        
        @php
            $notifications = auth()->user()->unreadNotifications;
        @endphp

        @if($notifications->isEmpty())
            <p class="text-gray-500">No new notifications.</p>
        @else
            <div class="space-y-3">
                @foreach($notifications as $notification)
                    <div class="border-l-4 border-purple-500 bg-purple-50 p-4 rounded">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-medium text-gray-900">{{ $notification->data['message'] }}</p>
                                <p class="text-sm text-gray-600 mt-1">
                                    {{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}
                                </p>
                            </div>
                            <form method="POST" action="{{ route('parent.notifications.mark-read', $notification->id) }}">
                                @csrf
                                <button type="submit" class="text-sm text-purple-600 hover:text-purple-800">
                                    Mark as read
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
