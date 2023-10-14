/**
 *
 */
import "../sass/app.scss";

/**
 *
 */
import $ from "jquery";

window.$ = window.jQuery = $;

/**
 *
 */
import "bootstrap";

/**
 *
 */
import Swal from "sweetalert2/dist/sweetalert2";

window.Swal = Swal;

/**
 *
 */
import Sortable from "sortablejs";

window.Sortable = Sortable;

/**
 *
 */
import Dropzone from "dropzone";

window.Dropzone = Dropzone;

/**
 *
 */
import Highlight from "highlight.js/lib/core";
import HighlightPhp from "highlight.js/lib/languages/php";
import HighlightBlade from "highlightjs-blade";

window.Highlight = Highlight;
window.Highlight.registerLanguage("php", HighlightPhp);
window.Highlight.registerLanguage("blade", HighlightBlade);
window.Highlight.HighlightJS = Highlight;
window.Highlight.default = Highlight;

/**
 *
 */
import CodeMirror from "codemirror";
import "codemirror/mode/php/php";
import "codemirror/addon/edit/closebrackets";
import "codemirror/addon/edit/closetag";
import "codemirror/addon/display/fullscreen";

window.CodeMirror = CodeMirror;
