// 📁 public/js/seo-analyzer.js

function analyzeSEO({
    title = '',
    slug = '',
    content = '',
    metaTitle = '',
    metaDescription = '',
    keyword = ''
  }) {
    let report = [];
    let score = 0;
    const wordCount = content.trim().split(/\s+/).length;
    const keywordCount = (content.toLowerCase().match(new RegExp(keyword.toLowerCase(), 'g')) || []).length;
    const keywordDensity = wordCount ? (keywordCount / wordCount) * 100 : 0;
  
    // Keyword in Title
    if (title.toLowerCase().includes(keyword.toLowerCase())) {
      score += 10;
      report.push('✅ Từ khóa xuất hiện trong tiêu đề.');
    } else {
      report.push('❌ Từ khóa KHÔNG có trong tiêu đề.');
    }
  
    // Keyword in URL
    if (slug.toLowerCase().includes(keyword.toLowerCase())) {
      score += 5;
      report.push('✅ Từ khóa có trong đường dẫn (URL).');
    } else {
      report.push('❌ Từ khóa KHÔNG có trong URL.');
    }
  
    // Keyword in content
    if (keywordCount > 0) {
      score += 10;
      report.push(`✅ Từ khóa xuất hiện ${keywordCount} lần trong nội dung.`);
    } else {
      report.push('❌ Từ khóa KHÔNG có trong nội dung.');
    }
  
    // Keyword density
    if (keywordDensity >= 1 && keywordDensity <= 3) {
      score += 10;
      report.push(`✅ Mật độ từ khóa hợp lý: ${keywordDensity.toFixed(2)}%.`);
    } else {
      report.push(`⚠️ Mật độ từ khóa không hợp lý: ${keywordDensity.toFixed(2)}%.`);
    }
  
    // Content length
    if (wordCount >= 300) {
      score += 10;
      report.push(`✅ Độ dài nội dung hợp lý (${wordCount} từ).`);
    } else {
      report.push(`⚠️ Nội dung quá ngắn (${wordCount} từ).`);
    }
  
    // Meta Title
    if (metaTitle.trim() !== '') {
      score += 10;
      report.push('✅ Meta title được cung cấp.');
    } else {
      report.push('❌ Thiếu meta title.');
    }
  
    // Meta Description
    if (metaDescription.trim() !== '') {
      score += 10;
      report.push('✅ Meta description được cung cấp.');
    } else {
      report.push('❌ Thiếu meta description.');
    }
  
    // ALT text for images
    const imgAlts = [...content.matchAll(/<img [^>]*alt=["']([^"']+)["'][^>]*>/gi)];
    const hasAltWithKeyword = imgAlts.some(match => match[1].toLowerCase().includes(keyword.toLowerCase()));
    if (hasAltWithKeyword) {
      score += 10;
      report.push('✅ Ít nhất một ảnh có ALT chứa từ khóa.');
    } else {
      report.push('❌ Không có ảnh ALT chứa từ khóa.');
    }
  
    // Internal links
    const internalLinks = (content.match(/<a [^>]*href=\"[^\"]*yourdomain\.com[^\"]*\"[^>]*>/gi) || []).length;
    if (internalLinks > 0) {
      score += 5;
      report.push(`✅ Có ${internalLinks} liên kết nội bộ.`);
    } else {
      report.push('⚠️ Không có liên kết nội bộ.');
    }
  
    // External links
    const externalLinks = (content.match(/<a [^>]*href=\"https?:\/\/(?!yourdomain\.com)[^\"]+\"[^>]*>/gi) || []).length;
    if (externalLinks > 0) {
      score += 5;
      report.push(`✅ Có ${externalLinks} liên kết ngoài.`);
    } else {
      report.push('⚠️ Không có liên kết ngoài.');
    }
  
    // Readability: Flesch test (approximation)
    const sentenceCount = content.split(/[.!?]/).length;
    const syllableCount = content.split(/\s+/).reduce((acc, word) => acc + Math.max(1, word.replace(/[^aeiouy]/gi, '').length), 0);
    const fleschScore = 206.835 - 1.015 * (wordCount / sentenceCount) - 84.6 * (syllableCount / wordCount);
    if (fleschScore >= 60) {
      score += 15;
      report.push(`✅ Độ dễ đọc cao (Flesch: ${fleschScore.toFixed(2)}).`);
    } else {
      report.push(`⚠️ Độ dễ đọc thấp (Flesch: ${fleschScore.toFixed(2)}).`);
    }
  
    return {
      score: Math.min(score, 100),
      report,
      fleschScore: fleschScore.toFixed(2)
    };
  }
  
  window.analyzeSEO = analyzeSEO;
  