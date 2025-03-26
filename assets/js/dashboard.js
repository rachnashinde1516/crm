
// Example function for updating dashboard statistics dynamically
function updateDashboardStats(stats) {
    document.getElementById('new-customers').innerText = stats.newCustomers;
    document.getElementById('total-sales').innerText = stats.totalSales;
    document.getElementById('pending-requests').innerText = stats.pendingRequests;
}
 
// Example data to update stats
const stats = {
    newCustomers: 120,
    totalSales: 500000,
    pendingRequests: 30
};
 
// Update stats when page loads
window.onload = function() {
    updateDashboardStats(stats);
};
