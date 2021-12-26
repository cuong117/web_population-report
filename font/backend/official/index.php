<div id="content" class="content-container">
    <div class="title">Quản lí cán bộ</div>
    <button id="add-button" class="add">Thêm
        <i class="material-icons">
            note_add
        </i>
    </button>
    <div class="add-div">
        <div class="row">
            <label>Mã cán bộ</label>
            <input type="text">
        </div>
        <div class="row">
            <label>Tên cán bộ</label>
            <input type="text">
        </div>
        <div class="row">
            <label>Cấp bậc</label>
            <input type="text">
        </div>
        <div class="row">
            <label>CMND</label>
            <input type="text">
        </div>
        <div class="row">
            <label>Khu vực phụ trách</label>
            <input type="text">
        </div>
        <button id="submit-add" class="add">Thêm thông tin</button>
    </div>
    <div class="main-div">
        <table id="official-table">
            <tr>
                <th>Mã cán bộ</th>
                <th>Tên cán bộ</th>
                <th>Cấp bậc</th>
                <th>CMND</th>
                <th>Khu vực phụ trách</th>
                <th>Thay đổi</th>
            </tr>
            <tbody id="list_data" contenteditable="true">
            </tbody>
        </table>
    </div>
</div>