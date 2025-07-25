<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use Illuminate\Support\Str;

class GenerateProductSlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-product-slugs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate slugs for existing products.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $products = Product::whereNull('slug')->orWhere('slug', '')->get();

        if ($products->isEmpty()) {
            $this->info('No products found without a slug.');
            return Command::SUCCESS;
        }

        $this->info('Generating slugs for ' . $products->count() . ' products...');

        foreach ($products as $product) {
            $slug = Str::slug($product->name);
            $originalSlug = $slug;
            $count = 1;

            while (Product::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }

            $product->slug = $slug;
            $product->save();
            $this->info('Generated slug for ' . $product->name . ': ' . $slug);
        }

        $this->info('All slugs generated successfully!');

        return Command::SUCCESS;
    }
}
