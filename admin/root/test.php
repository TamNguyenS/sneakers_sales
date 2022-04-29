<form action=" " name="test">

    <select class="fillter-orders" name="status">

        <option disabled selected value="">Loại đơn </option>
        <option value="2">Đơn hủy</option>
        <option value="1">Đơn duyệt</option>
        <option value="0">Chờ duyệt</option>

    </select>
    <input type="submit" />
</form>

<!-- <script>
    $('form').on('click', '[type=submit]', function(e) {
        e.preventDefault();
        var form = $(this).parents('form');
        var selectVal = $form.find('select').find(':selected').val();
        var url = '';
        switch (selectVal) {
            case '1':
                url = 'google.com';
                break;
            case '2':
                url = 'yahoo.com';
                break;
        }

        // if (url) {
        //     form.attr('action', url);
        //     form.submit();
        // }
    })
</script> -->