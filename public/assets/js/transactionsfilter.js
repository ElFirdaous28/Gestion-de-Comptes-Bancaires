function loadTransactions(accountType = '', transactionType = '',motif='',amountMin=0,amountMax=0) {
    // Perform AJAX request to fetch transactions
    $.ajax({
        url: '/client/transactionsList',
        method: 'GET',
        data: {accountType: accountType, transactionType: transactionType,motif: motif,amountMax: amountMax,amountMin: amountMin},
        success: function(response) {
            $('#transactionsList').html(response); // Inject the returned HTML
        },
        error: function(error) {
            console.error("Error fetching transactions:", error);
        }
    });
}

// Load all transactions when the page loads
$(document).ready(function() {
    loadTransactions();
});

// Event listener for select changes
$('#account_type_select, #transaction_type_select').change(function() {
    const accountType = $('#account_type_select').val();
    const transactionType = $('#transaction_type_select').val();
    const motif = $('#motif_input').val();
    const amountMin = $('#min_amount_input').val();
    const amountMax = $('#max_amount_input').val();

    loadTransactions(accountType, transactionType, motif, amountMin,amountMax);
});

// Event listener for input field keyup (motif_input and min_amount_input)
$('#motif_input, #min_amount_input,#max_amount_input').keyup(function() {
    const accountType = $('#account_type_select').val();
    const transactionType = $('#transaction_type_select').val();
    const motif = $('#motif_input').val();
    const amountMin = $('#min_amount_input').val();
    const amountMax = $('#max_amount_input').val();

    loadTransactions(accountType, transactionType, motif,amountMin,amountMax);
});

// Initial load when the page loads (in case there's pre-existing data)
$(document).ready(function() {
    loadTransactions();
});