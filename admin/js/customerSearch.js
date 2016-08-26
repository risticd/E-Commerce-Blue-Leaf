    $(document).ready(function(){
        /*
         Set the inner html of the table, tell the user to enter a search term to get started.
         We could place this anywhere in the document. I chose to place it
         in the table.
        */
        $('#customerResults').html('<p style="padding:5px;">Search Results</p>');

        /* When the user enters a value such as "j" in the search box
         * we want to run the .get() function. */
        $('#cust_search').keyup(function() {

            /* Get the value of the search input each time the keyup() method fires so we
             * can pass the value to our .get() method to retrieve the data from the database */
            var searchVal = $(this).val();

            /* If the searchVal var is NOT empty then check the database for possible results
             * else display message to user */
            if(searchVal !== '') {

                /* Fire the .get() method for and pass the searchVal data to the
                 * search-data.php file for retrieval */
                $.get('data/cust-search.php?cust_search='+searchVal, function(returnData) {
                    /* If the returnData is empty then display message to user
                     * else our returned data results in the table.  */
                    if (!returnData) {
                        $('#customerResults').html('<p style="padding:5px;">No results found</p>');
                    } else {
                        $('#customerResults').html(returnData);
                    }
                });
            } else {
                $('#customerResults').html('<p style="padding:5px;">Search Results</p>');
            }

        });

    });