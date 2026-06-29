<?php

namespace App\Http\Controllers;

use App\Models\InventoryNotification;
use App\Support\CollectionPaginator;
use App\Support\InventorySchema;
use App\Support\InventoryNotificationService;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        if (! InventorySchema::hasNotificationsTable()) {
            return response()->json([
                'count' => 0,
                'items' => [],
            ]);
        }

        InventoryNotificationService::syncStockAlerts();

        return response()->json([
            'count' => InventoryNotificationService::unreadCount(),
            'items' => InventoryNotification::query()
                ->visible()
                ->latest()
                ->limit(12)
                ->get()
                ->map(fn (InventoryNotification $notification) => [
                    'id' => $notification->id,
                    'icon' => $notification->icon,
                    'title' => $notification->title,
                    'description' => $notification->description,
                    'date' => $notification->created_at->diffForHumans(),
                    'read' => $notification->read_at !== null,
                    'status' => $notification->read_at !== null ? 'Leído' : 'No leído',
                ]),
        ]);
    }

    public function page()
    {
        if (! InventorySchema::hasNotificationsTable()) {
            return view('notifications.index', [
                'notifications' => CollectionPaginator::paginate(collect(), 20)->withQueryString(),
            ]);
        }

        InventoryNotificationService::syncStockAlerts();

        $notifications = InventoryNotification::query()
            ->visible()
            ->latest()
            ->paginate(20);

        return view('notifications.index', compact('notifications'));
    }

    public function markAllRead()
    {
        if (! InventorySchema::hasNotificationsTable()) {
            return request()->wantsJson()
                ? response()->json(['success' => true])
                : back()->with('success', 'No hay notificaciones configuradas todavía.');
        }

        InventoryNotification::query()
            ->visible()
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        if (request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Todas las notificaciones fueron marcadas como leídas.');
    }

    public function markRead(InventoryNotification $notification)
    {
        if (! InventorySchema::hasNotificationsTable()) {
            return request()->wantsJson()
                ? response()->json(['success' => true])
                : back()->with('success', 'No hay notificaciones configuradas todavía.');
        }

        $notification->markAsRead();

        if (request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Notificación marcada como leída.');
    }

    public function destroy(InventoryNotification $notification)
    {
        if (! InventorySchema::hasNotificationsTable()) {
            return request()->wantsJson()
                ? response()->json(['success' => true])
                : back()->with('success', 'No hay notificaciones configuradas todavía.');
        }

        $notification->update(['deleted_at' => now()]);

        if (request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Notificación eliminada correctamente.');
    }
}
