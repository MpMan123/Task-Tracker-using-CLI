#!/bin/bash

# Tên alias bạn muốn tạo
ALIAS_NAME="task-cli"

# Đường dẫn tuyệt đối đến file PHP (script chính)
SCRIPT_PATH="$(pwd)/app.php"

# Kiểm tra alias đã tồn tại chưa
if grep -q "alias $ALIAS_NAME=" ~/.bashrc; then
    echo "⚠️ Alias '$ALIAS_NAME' đã tồn tại trong ~/.bashrc"
else
    echo "➕ Đang thêm alias vào ~/.bashrc ..."
    echo "alias $ALIAS_NAME='php $SCRIPT_PATH'" >> ~/.bashrc
    echo "✅ Alias '$ALIAS_NAME' đã được thêm."
fi

# Nạp lại file cấu hình ngay lập tức
echo "🔄 Nạp lại ~/.bashrc ..."
source ~/.bashrc

echo "🚀 Bây giờ bạn có thể chạy lệnh:"
echo "   $ALIAS_NAME add 'Học PHP CLI'"
