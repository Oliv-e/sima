<?php

namespace App\Http\Controllers;

use App\Models\Quotes;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function index()
    {
        $quote = Quotes::orderByDesc('ditampilkan')->get();
        return view('admin.quote.index', compact('quote'));
    }

    public function tambah()
    {
        return view('admin.quote.tambah');
    }

    public function insert(Request $request)
    {
        $data = $this->validateData($request);

        // If ditampilkan is set, reset others
        if ($data['ditampilkan']) {
            Quotes::where('ditampilkan', true)->update(['ditampilkan' => false]);
        }

        Quotes::create($data);

        return redirect()->route('quote.index')->with('success', 'Data Berhasil Ditambah');
    }

    public function edit(Quotes $data)
    {
        return view('admin.quote.edit', compact('data'));
    }

    public function update(Request $request, Quotes $data)
    {
        $validated = $this->validateData($request);

        if ($validated['ditampilkan']) {
            Quotes::where('ditampilkan', true)->where('id', '!=', $data->id)->update(['ditampilkan' => false]);
        }

        $data->update($validated);

        return redirect()->route('quote.index')->with('success', 'Data Berhasil Diganti');
    }

    public function delete(Quotes $data)
    {
        $wasDisplayed = $data->ditampilkan;
        $data->delete();

        // Optionally set another quote as displayed if the deleted one was displayed
        if ($wasDisplayed) {
            Quotes::first()?->update(['ditampilkan' => true]);
        }

        return redirect()->route('quote.index')->with('success', 'Data Berhasil Dihapus');
    }

    /**
     * Validate quote data
     */
    protected function validateData(Request $request): array
    {
        $validated = $request->validate([
            'quote1' => 'string|max:255',
            'quote2' => 'string|max:255',
            'quote3' => 'string|max:255',
            'ditampilkan' => 'sometimes|accepted',
        ]);

        // Standardize ditampilkan to boolean
        $validated['ditampilkan'] = $request->has('ditampilkan');

        return $validated;
    }
}
