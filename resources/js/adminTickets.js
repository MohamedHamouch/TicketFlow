function openAssignModal(ticketId) {
    const modal = document.getElementById('assignModal');
    const form = document.getElementById('assignForm');
    form.action = `/admin/tickets/${ticketId}/assign`;
    modal.classList.remove('hidden');
}

function closeAssignModal() {
    const modal = document.getElementById('assignModal');
    modal.classList.add('hidden');
}

// Make functions globally available
window.openAssignModal = openAssignModal;
window.closeAssignModal = closeAssignModal;