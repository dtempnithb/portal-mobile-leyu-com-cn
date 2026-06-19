<?php

namespace App\Utils;

/**
 * 链接卡片渲染器
 * 生成安全转义的 HTML 结构
 */
class LinkCard
{
    /**
     * 默认配置
     */
    private array $config;

    public function __construct(array $config = [])
    {
        $defaults = [
            'target_url' => 'https://portal-mobile-leyu.com.cn',
            'site_name'  => '乐鱼体育',
            'title'      => '乐鱼体育 - 精彩赛事在线',
            'description'=> '乐鱼体育汇聚全球顶级体育赛事，提供高清直播与实时数据。',
        ];

        $this->config = array_merge($defaults, $config);
    }

    /**
     * 根据配置生成卡片 HTML
     *
     * @param  array|null  $override  临时覆盖配置
     * @return string
     */
    public function render(array $override = null): string
    {
        $params = $this->config;
        if (is_array($override)) {
            $params = array_merge($params, $override);
        }

        // 对每个输出字段做 HTML 转义
        $url   = htmlspecialchars($params['target_url'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $name  = htmlspecialchars($params['site_name'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $title = htmlspecialchars($params['title'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $desc  = htmlspecialchars($params['description'], ENT_QUOTES | ENT_HTML5, 'UTF-8');

        // 构造卡片 HTML（纯基础语法，无外部依赖）
        $html  = '<div class="link-card">' . "\n";
        $html .= '  <a href="' . $url . '" target="_blank" rel="noopener noreferrer">' . "\n";
        $html .= '    <div class="card-body">' . "\n";
        $html .= '      <span class="card-site">' . $name . '</span>' . "\n";
        $html .= '      <h3 class="card-title">' . $title . '</h3>' . "\n";
        $html .= '      <p class="card-desc">' . $desc . '</p>' . "\n";
        $html .= '    </div>' . "\n";
        $html .= '  </a>' . "\n";
        $html .= '</div>' . "\n";

        return $html;
    }

    /**
     * 直接使用固定示例数据生成卡片
     *
     * @return string
     */
    public static function demoCard(): string
    {
        $instance = new self();
        return $instance->render();
    }

    /**
     * 使用自定义数据生成卡片（便捷静态方法）
     *
     * @param  string  $url
     * @param  string  $site
     * @param  string  $title
     * @param  string  $desc
     * @return string
     */
    public static function customCard(
        string $url = 'https://portal-mobile-leyu.com.cn',
        string $site = '乐鱼体育',
        string $title = '乐鱼体育 - 顶级赛事',
        string $desc  = '乐鱼体育提供足球、篮球、网球等海量赛事直播。'
    ): string {
        $instance = new self([
            'target_url' => $url,
            'site_name'  => $site,
            'title'      => $title,
            'description'=> $desc,
        ]);
        return $instance->render();
    }
}