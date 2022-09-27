function search(searchPath) {
    let keyWord = $('#'+ searchPath +'_search input').val();
    if (keyWord !== "") {
        $.post('/dashboard/' + searchPath + '/search', {
            'keyWord': keyWord,
        }).then(function (response) {
            $("#result-item").html(
                '<div id="loading" class="text-center list-group-item"> <div class = "spinner-border" role = "status" ><span class = "visually-hidden"> </span> </div> </div>'
            );
            let resultHtml = '<div class="list-group-item">查無資料</div>';
            if (Object.keys(response).length !== 0) {
                resultHtml = response.map(function (value, index) {
                    return `<a href="{{ url('/dashboard/${searchPath}/${value.id}') }}" class="list-group-item">${value.name}</a>`;
                }).join('');
            }
            $('#loading').hide();
            $('#loading').after(resultHtml);
            $('#'+ searchPath +'_search').next('.sidebar-search-results').show();
            $('#search_btn').html('<i id="search_close" class="fas fa-fw fa-times"></i>');
        });
    } else {
        return;
    }
}
