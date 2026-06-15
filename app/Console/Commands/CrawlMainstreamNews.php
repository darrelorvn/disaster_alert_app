<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Symfony\Component\DomCrawler\Crawler;
use App\Models\DisasterNews;

class CrawlMainstreamNews extends Command
{
    protected $signature = 'scrape:bnpb-news';

    protected $description = 'Crawl berita terbaru dari situs BNPB';

    public function handle()
    {
        $response = Http::get('https://bnpb.go.id/berita');

        if ($response->successful()) {
            $crawler = new Crawler($response->body());

            $crawler->filter('.block.mb-4')->each(function (Crawler $node) {
                try {
                    $title = $node->filter('.title a')->text();
                    $url = $node->filter('.title a')->attr('href');
                    $image_url = $node->filter('.img img')->attr('src');

                    if (DisasterNews::where('url', $url)->exists()) {
                        return;
                    }

                    $detailResponse = Http::get($url);
                    $detailCrawler = new Crawler($detailResponse->body());
                    $summaryText = $detailCrawler->filter('p')->first()->text();
                    $summary = Str::limit($summaryText, 200);

                    DisasterNews::create([
                        'title' => $title,
                        'url' => $url,
                        'image_url' => $image_url,
                        'summary' => $summary,
                    ]);
                } catch (\Exception $e) {
                }
            });
        }

        $this->info('Proses crawling berita BNPB selesai.');
    }
}
