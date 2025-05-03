<!-- app/Views/admin/news/seo_panel.php -->
<div class="seo-analyzer-panel" style="background: #f9f9f9; border: 1px solid #ccc; padding: 1rem; border-radius: 8px; margin-top: 2rem;">
    <h4 style="color: #2b5d95;">🧠 Đánh giá SEO & Readability</h4>
    <p><strong>Từ khoá chính:</strong> <?= esc($meta_keyword ?? '') ?></p>
    <p><strong>Mật độ từ khoá:</strong> <span id="keyword-density">--</span></p>
    <p><strong>Số câu:</strong> <span id="sentence-count">--</span></p>
    <p><strong>Số từ:</strong> <span id="word-count">--</span></p>
    <p><strong>Chỉ số Flesch:</strong> <span id="flesch-score">--</span></p>

    <div id="improvement-suggestions" style="margin-top: 1rem;">
        <strong>🛠 Gợi ý cải thiện:</strong>
        <ul id="suggestion-list" style="margin-top: 0.5rem; color: #e74c3c;"></ul>
    </div>
</div>
