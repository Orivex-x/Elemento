<?php

namespace Elemento;

use BadMethodCallException;
use Elemento\Elements\{A, Article, Aside, Br, Button, Div, Fieldset, Footer, Form, H1, H2, H3, H4, H5, H6, Header, Hr, Img, Input, Label, Legend, Li, Main, Nav, Ol, P, Section, Select, Span, Table, Tbody, Td, Textarea, Tfoot, Th, Thead, Tr, Ul};
use Elemento\Form\FormBuilder;
use Elemento\Macro\MacroRegistry;
use Elemento\Security\CSRFToken;
use Elemento\Theme\ThemeInterface;
use Elemento\Theme\ThemeManager;
use Random\RandomException;

class Elemento
{
    /**
     * Perform the element operation.
     *
     * @param array $attributes
     *
     * @return Form
     */
    public static function form(array $attributes = []): Form
    {
        return new Form($attributes);
    }

    /**
     * Perform the element operation.
     *
     * @param string $type
     * @param array $attributes
     *
     * @return Input
     */
    public static function input(string $type = 'text', array $attributes = []): Input
    {
        return new Input($type, $attributes);
    }

    /**
     * Perform the element operation.
     *
     * @param string $text
     * @param array $attributes
     *
     * @return Button
     */
    public static function button(string $text = '', array $attributes = []): Button
    {
        return new Button($text, $attributes);
    }

    /**
     * Perform the element operation.
     *
     * @param array $attributes
     *
     * @return Div
     */
    public static function div(array $attributes = []): Div
    {
        return new Div($attributes);
    }

    /**
     * Perform the element operation.
     *
     * @param string $text
     * @param array $attributes
     *
     * @return Label
     */
    public static function label(string $text = '', array $attributes = []): Label
    {
        return new Label($text, $attributes);
    }

    /**
     * Perform the element operation.
     *
     * @param array $attributes
     *
     * @return Select
     */
    public static function select(array $attributes = []): Select
    {
        return new Select($attributes);
    }

    /**
     * Perform the element operation.
     *
     * @param array $attributes
     *
     * @return TextArea
     */
    public static function textarea(array $attributes = []): TextArea
    {
        return new TextArea($attributes);
    }

    /**
     * Perform the element operation.
     *
     * @param array $attributes
     *
     * @return Fieldset
     */
    public static function fieldset(array $attributes = []): Fieldset
    {
        return new Fieldset($attributes);
    }

    /**
     * Perform the element operation.
     *
     * @param string $text
     * @param array $attributes
     *
     * @return Legend
     */
    public static function legend(string $text = '', array $attributes = []): Legend
    {
        return new Legend($text, $attributes);
    }

    /**
     * Perform the element operation.
     *
     * @param string $tag
     * @param array $attributes
     *
     * @return Element
     */
    public static function element(string $tag, array $attributes = []): Element
    {
        return new GenericElement($tag, $attributes);
    }

    /**
     * Perform the element operation.
     *
     * @param string $text
     * @param array $attributes
     *
     * @return Element
     */
    public static function h1(string $text = '', array $attributes = []): Element
    {
        return new H1($text, $attributes);
    }

    /**
     * Perform the element operation.
     *
     * @param string $text
     * @param array $attributes
     *
     * @return Element
     */
    public static function h2(string $text = '', array $attributes = []): Element
    {
        return new H2($text, $attributes);
    }

    /**
     * Perform the element operation.
     *
     * @param string $text
     * @param array $attributes
     *
     * @return Element
     */
    public static function h3(string $text = '', array $attributes = []): Element
    {
        return new H3($text, $attributes);
    }

    /**
     * Perform the element operation.
     *
     * @param string $text
     * @param array $attributes
     *
     * @return Element
     */
    public static function h4(string $text = '', array $attributes = []): Element
    {
        return new H4($text, $attributes);
    }

    /**
     * Perform the element operation.
     *
     * @param string $text
     * @param array $attributes
     *
     * @return Element
     */
    public static function h5(string $text = '', array $attributes = []): Element
    {
        return new H5($text, $attributes);
    }

    /**
     * Perform the element operation.
     *
     * @param string $text
     * @param array $attributes
     *
     * @return Element
     */
    public static function h6(string $text = '', array $attributes = []): Element
    {
        return new H6($text, $attributes);
    }

    /**
     * Perform the element operation.
     *
     * @param string $text
     * @param array $attributes
     *
     * @return Element
     */
    public static function p(string $text = '', array $attributes = []): Element
    {
        return new P($text, $attributes);
    }

    /**
     * Perform the element operation.
     *
     * @param string $text
     * @param array $attributes
     *
     * @return Element
     */
    public static function span(string $text = '', array $attributes = []): Element
    {
        return new Span($text, $attributes);
    }

    /**
     * Perform the element operation.
     *
     * @param string $text
     * @param string $href
     * @param array $attributes
     *
     * @return Element
     */
    public static function a(string $text, string $href = '#', array $attributes = []): Element
    {
        $attributes['href'] = $href;

        return (new A($attributes))->text($text);
    }

    /**
     * Perform the element operation.
     *
     * @param string $src
     * @param array $attributes
     *
     * @return Element
     */
    public static function img(string $src, array $attributes = []): Element
    {
        $attributes['src'] = $src;

        return new Img($attributes);
    }

    /**
     * Perform the element operation.
     *
     * @param array $attributes
     *
     * @return Element
     */
    public static function ul(array $attributes = []): Element
    {
        return new Ul($attributes);
    }

    /**
     * Perform the element operation.
     *
     * @param array $attributes
     *
     * @return Element
     */
    public static function ol(array $attributes = []): Element
    {
        return new Ol($attributes);
    }

    /**
     * Perform the element operation.
     *
     * @param string $text
     * @param array $attributes
     *
     * @return Element
     */
    public static function li(string $text = '', array $attributes = []): Element
    {
        return new Li($text, $attributes);
    }

    /**
     * Perform the element operation.
     *
     * @param array $attributes
     *
     * @return Element
     */
    public static function table(array $attributes = []): Element
    {
        return new Table($attributes);
    }

    /**
     * Perform the element operation.
     *
     * @param array $attributes
     *
     * @return Element
     */
    public static function thead(array $attributes = []): Element
    {
        return new Thead($attributes);
    }

    /**
     * Perform the element operation.
     *
     * @param array $attributes
     *
     * @return Element
     */
    public static function tbody(array $attributes = []): Element
    {
        return new Tbody($attributes);
    }

    /**
     * Perform the element operation.
     *
     * @param array $attributes
     *
     * @return Element
     */
    public static function tfoot(array $attributes = []): Element
    {
        return new Tfoot($attributes);
    }

    /**
     * Perform the element operation.
     *
     * @param array $attributes
     *
     * @return Element
     */
    public static function tr(array $attributes = []): Element
    {
        return new Tr($attributes);
    }

    /**
     * Perform the element operation.
     *
     * @param string $text
     * @param array $attributes
     *
     * @return Element
     */
    public static function td(string $text = '', array $attributes = []): Element
    {
        return new Td($text, $attributes);
    }

    /**
     * Perform the element operation.
     *
     * @param string $text
     * @param array $attributes
     *
     * @return Element
     */
    public static function th(string $text = '', array $attributes = []): Element
    {
        return new Th($text, $attributes);
    }

    /**
     * Perform the element operation.
     *
     * @param array $attributes
     *
     * @return Element
     */
    public static function nav(array $attributes = []): Element
    {
        return new Nav($attributes);
    }

    /**
     * Perform the element operation.
     *
     * @param array $attributes
     *
     * @return Element
     */
    public static function section(array $attributes = []): Element
    {
        return new Section('', $attributes);
    }

    /**
     * Perform the element operation.
     *
     * @param array $attributes
     *
     * @return Element
     */
    public static function article(array $attributes = []): Element
    {
        return new Article($attributes);
    }

    /**
     * Perform the element operation.
     *
     * @param array $attributes
     *
     * @return Element
     */
    public static function header(array $attributes = []): Element
    {
        return new Header('', $attributes);
    }

    /**
     * Perform the element operation.
     *
     * @param array $attributes
     *
     * @return Element
     */
    public static function footer(array $attributes = []): Element
    {
        return new Footer('', $attributes);
    }

    /**
     * Perform the element operation.
     *
     * @param array $attributes
     *
     * @return Element
     */
    public static function main(array $attributes = []): Element
    {
        return new Main($attributes);
    }

    /**
     * Perform the element operation.
     *
     * @param array $attributes
     *
     * @return Element
     */
    public static function aside(array $attributes = []): Element
    {
        return new Aside($attributes);
    }

    /**
     * Perform the element operation.
     *
     * @return Element
     */
    public static function br(): Element
    {
        return new Br();
    }

    /**
     * Perform the element operation.
     *
     * @param array $attributes
     *
     * @return Element
     */
    public static function hr(array $attributes = []): Element
    {
        return new Hr($attributes);
    }

    /**
     * Perform the element operation.
     *
     * @param array $attributes
     *
     * @return FormBuilder
     */
    public static function createForm(array $attributes = []): FormBuilder
    {
        return new FormBuilder($attributes);
    }

    /**
     * Perform the element operation.
     *
     * @param string $action
     * @param array $attributes
     *
     * @return FormBuilder
     */
    public static function postForm(string $action, array $attributes = []): FormBuilder
    {
        return FormBuilder::post($action, $attributes);
    }

    /**
     * Get the configured value.
     *
     * @param string $action
     * @param array $attributes
     *
     * @return FormBuilder
     */
    public static function getForm(string $action, array $attributes = []): FormBuilder
    {
        return FormBuilder::get($action, $attributes);
    }

    /**
     * Perform the element operation.
     *
     * @param string $action
     * @param array $attributes
     *
     * @return FormBuilder
     */
    public static function putForm(string $action, array $attributes = []): FormBuilder
    {
        return FormBuilder::put($action, $attributes);
    }

    /**
     * Perform the element operation.
     *
     * @param string $action
     * @param array $attributes
     *
     * @return FormBuilder
     */
    public static function deleteForm(string $action, array $attributes = []): FormBuilder
    {
        return FormBuilder::delete($action, $attributes);
    }

    // THEME
    /**
     * Perform the element operation.
     *
     * @param ThemeInterface $theme
     *
     * @return void
     */
    public static function setTheme(ThemeInterface $theme): void
    {
        ThemeManager::setTheme($theme);
    }

    /**
     * Get the configured value.
     *
     * @return ThemeInterface
     */
    public static function getTheme(): ThemeInterface
    {
        return ThemeManager::getTheme();
    }

    /**
     * Perform the element operation.
     *
     * @param string $text
     * @param string $type
     *
     * @return Element
     */
    public static function buttonThemed(string $text, string $type = 'primary'): Element
    {
        return ThemeManager::button($text, $type);
    }

    /**
     * Perform the element operation.
     *
     * @param string $title
     * @param string $content
     *
     * @return Element
     */
    public static function card(string $title, string $content): Element
    {
        return ThemeManager::card($title, $content);
    }

    /**
     * Perform the element operation.
     *
     * @param string $message
     * @param string $type
     *
     * @return Element
     */
    public static function alert(string $message, string $type = 'info'): Element
    {
        return ThemeManager::alert($message, $type);
    }

    /**
     * Perform the element operation.
     *
     * @param string $text
     * @param string $type
     *
     * @return Element
     */
    public static function badge(string $text, string $type = 'primary'): Element
    {
        return ThemeManager::badge($text, $type);
    }

    /**
     * Perform the element operation.
     *
     * @return string
     * @throws RandomException
     */
    public static function csrf(): string
    {
        return CSRFToken::getToken();
    }

    /**
     * Perform the element operation.
     *
     * @param string $fieldName
     *
     * @return Input
     * @throws RandomException
     */
    public static function csrfField(string $fieldName = '_token'): Input
    {
        return self::input('hidden')
            ->name($fieldName)
            ->value(CSRFToken::getToken());
    }

    /**
     * Perform the element operation.
     *
     * @param string $token
     *
     * @return bool
     * @throws RandomException
     */
    public static function verifyCsrf(string $token): bool
    {
        return CSRFToken::verify($token);
    }

    // Macros
    /**
     * Perform the element operation.
     *
     * @param string $name
     * @param callable $callback
     *
     * @return void
     */
    public static function macro(string $name, callable $callback): void
    {
        MacroRegistry::register($name, $callback);
    }

    /**
     * Perform the element operation.
     *
     * @param string $name
     * @param array $arguments
     *
     * @return mixed
     */
    public static function callMacro(string $name, array $arguments = []): mixed
    {
        return MacroRegistry::call($name, $arguments);
    }

    /**
     * Perform the element operation.
     *
     * @param string $name
     * @param array $arguments
     *
     * @return mixed
     */
    public static function __callStatic(string $name, array $arguments = [])
    {
        if (MacroRegistry::exists($name)) {
            return MacroRegistry::call($name, $arguments);
        }

        throw new BadMethodCallException('Call to undefined method ' . self::class . " with method '$name'.");
    }
}
