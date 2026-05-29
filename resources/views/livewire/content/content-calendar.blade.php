<div>
    <x-ui.card class="p-0 overflow-hidden">
        <div class="px-4 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Content Calendar</h3>
            <x-ui.button size="sm" @click="$wire.set('showComposer', true)">+ New Post</x-ui.button>
        </div>

        <div class="p-4 bg-white dark:bg-gray-800">
            <div x-data="calendar($wire)" x-init="init()" x-ref="calendar" class="h-[650px]"></div>
        </div>
    </x-ui.card>

    <x-ui.modal :open="$showComposer" title="Schedule Content" size="lg" x-on:close="$wire.set('showComposer', false)">
        <livewire:content.post-composer />
    </x-ui.modal>
</div>

@push('styles')
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css' rel='stylesheet' />
<style>
    /* Dark mode overrides for FullCalendar */
    .dark .fc { --fc-border-color: theme('colors.gray.700'); --fc-page-bg-color: theme('colors.gray.800'); --fc-neutral-bg-color: theme('colors.gray.700'); }
    .dark .fc-daygrid-day { background-color: theme('colors.gray.800'); }
    .dark .fc-col-header-cell { background-color: theme('colors.gray.900'); color: theme('colors.gray.300'); }
    .dark .fc-list-day-cushion { background-color: theme('colors.gray.900'); }
    .fc-daygrid-day-number { color: inherit; }
    .dark .fc-daygrid-day-number { color: theme('colors.gray.300'); }
</style>
@endpush

@push('scripts')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<script>
function calendar(wire) {
    return {
        init() {
            const calendar = new FullCalendar.Calendar(this.$refs.calendar, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,listMonth'
                },
                height: '100%',
                editable: true,
                selectable: true,
                datesSet: (dateInfo) => {
                    wire.fetchEvents(dateInfo.start.toISOString(), dateInfo.end.toISOString());
                },
                eventClick: (info) => {
                    wire.$dispatch('edit-post', { id: info.event.id });
                },
                eventDrop: (info) => {
                    wire.$dispatch('update-schedule', { id: info.event.id, newStart: info.event.start.toISOString() });
                },
                select: (info) => {
                    wire.$dispatch('quick-schedule', { start: info.start.toISOString(), end: info.end?.toISOString() });
                    calendar.unselect();
                }
            });
            calendar.render();

            wire.on('events-loaded', (events) => {
                calendar.removeAllEvents();
                calendar.addEventSource(events);
            });
        }
    }
}
</script>
@endpush